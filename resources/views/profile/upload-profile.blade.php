
 <div class="container-fluid">

    <div class="row">
        <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
         @csrf
            <input type="file" name="file_image" id="customFile">
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
    </div>
</div>
