<style type="text/css">
    input, textarea{
        margin: 3px 0px;
        width: 250px;
    }
</style>
<form method="POST" action="" enctype="multipart/form-data">
    Select a song to upload:
    <br>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <br>
    <input type="text" name="title" placeholder="Title">
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