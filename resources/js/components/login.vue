<template>


<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="text-center border border-light p-5" role="form">

            <p class="h4 mb-4">Sign in</p>
            <!-- Email -->
            <input type="email" id="email" class="form-control mb-4" v-model="email" placeholder="E-mail">

            <!-- Password -->
            <input type="password" id="password" class="form-control mb-4" v-model="password" placeholder="Password">

            <div class="d-flex justify-content-around">
                <div>
                    <!-- Remember me -->
                    <div class="custom-control">
                        <input type="checkbox" id="remember_me" v-model="remember_me">
                        <label for="defaultLoginFormRemember"> Remember me</label>
                    </div>
                </div>
                <div>
                    <!-- Forgot password -->
                    <a href="">Forgot password?</a>
                </div>
            </div>

            <!-- Sign in button -->
            <button class="btn btn-info btn-block my-4"  :disabled="!isValidLogin" @click="attemptLogin()" >Sign in</button>

            <!-- Register -->
            <p>Not a member?
                <a href="">Register</a>
            </p>

            <!-- Social login -->
            <p>or sign in with:</p>

            <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-twitter light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-linkedin-in light-blue-text"></i></a>
            <a href="#" class="mx-2" role="button"><i class="fab fa-github light-blue-text"></i></a>

        </form>
<!-- Default form login -->

      </div>
    </div>
  </div>
</div>

</template>

<script>

 import axios from "axios";
  export default {
    data() {
      return {
        modalShow: false,
        email: '',
        password: '',
        remember_me: false,
      }
    },
    methods:{

     validateEmail(email) {
            if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email)){
                return true;
            }else{
                return false;
            }
             },

             attemptLogin()
            {
                this.loading = true
                axios.post('/login',

                {
                email:this.email, password:this.password, remember_me:this.remember_me
            }).then(function (response) {
                  location.href  = '/home';
                // window.location.href = '/home';
                console.log(response);
            }).catch(function (error) {
                 alert("Incorrect credentails");



            });
            }


    },
    computed:{
        isValidLogin()
        {
            return this.validateEmail() && this.password
        }
    }
  }
</script>

