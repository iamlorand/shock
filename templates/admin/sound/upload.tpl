<form method="POST" action="" enctype="multipart/form-data">
    <div class="box-shadow" style="width: 500px">
        <div class="box_header">
            Select a song to upload:
        </div>
        <ul class="form">
            <li class="clearfix">
                <label>Song file<span class="required">*</span></label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </li>
            <li class="clearfix">
                <label>Title<span class="required">*</span></label>
                <input type="text" name="title" placeholder="Title">
            </li>
            <li class="clearfix">
                <label>Description<span class="required">*</span></label>
                <textarea name="description" placeholder="Description"></textarea>
            </li>
            <li class="clearfix">
                <label>Tags<span class="required">*</span></label>
                <input type="text" name="tags" placeholder="Tags">
            </li>
            <li class="clearfix">
                <label>Thumbnail file</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </li>
            <li class="clearfix">
                <label>&nbsp;</label>
                <input type="submit" class="button" value="add">
            </li>
        </ul>
    </div>
</form>