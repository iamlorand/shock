<style type="text/css">
    form, input, textarea{
        width: 250px;
        margin: auto;
    }
    .upload{
        width: 50%;
        margin: auto;
    }
</style>
<div class="upload">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 style="text-align: center;">Select a song to upload:</h3> 
        </div>
        <div class="panel-body">
            <form method="POST" action="" enctype="multipart/form-data">
                <br>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <br>
                <input type="text" name="title" placeholder="" aceholder="Title">
                <br>
                <textarea name="description" placeholder="Description"></textarea>
                <br>
                <input type="text" name="tags" placeholder="Tags">
                <br>
                Thumbnail:
                <br>
                <input type="file" name="thumbnail" id="thumbnail">
                <br>
                <input type="submit" value="Upload File">
            </form> 
        </div>
    </div>
</div>
