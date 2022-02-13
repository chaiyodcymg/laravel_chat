
 <div class="container-fluid" style="height:50vh">

    <div class="row d-flex justify-content-center align-content-center flex-column">
        
        <form action="{{route('upload')}}" method="post" enctype="multipart/form-data">
         @csrf
            <input type="file" name="file_image" id="customFile" onchange="show_image(this)">
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
       <img  style="width:300px">
      
    </div>
     <script>
        //  function show_image(event){
        //     let file  =  document.getElementById("customFile");
        //     console.log(event);
        //  }
     </script>
</div>
