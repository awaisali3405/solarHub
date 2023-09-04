@if(session()->has('success'))
    <div class="alert alert-success alert-dismissible" style="margin: 0px;padding: 0px;">
        <button type="button" class="close" data-dismiss="alert" style="padding: 0px;">&times;</button>
        <strong>Success!</strong> {!! __(session()->get('success')) !!}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible" style="margin: 0px;padding: 0px;">
        <button type="button" class="close" data-dismiss="alert" style="padding: 0px;">&times;</button>
        <strong>Danger!</strong> {!! __(session()->get('error')) !!}.
    </div>
@endif
