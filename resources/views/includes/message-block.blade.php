@if(count($errors) > 0)
    <div class="row">
        <div class="col-md-4 col-md-offset-4 error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('message'))
    <div class="row" id="messagebox">
        <div class="col-md-4 col-md-offset-4 success">
            <button onclick="removeMessages()">[X]</button>
            {{Session::get('message')}}
        </div>
    </div>
    <script>
        function removeMessages() {
            document.getElementById("messagebox").remove();
        }
    </script>
@endif