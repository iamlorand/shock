<form method="POST" action="" enctype="multipart/form-data">
    <div class="box-shadow" style="width: 500px">
        <div class="box_header">
            Update song details:
        </div>
        <ul class="form">
            <li class="clearfix">
                <label>Song file<span class="required">*</span></label>
                <input type="file" name="fileToUpload" id="fileToUpload" value="{SONG_FILENAME}">
            </li>
            <li class="clearfix">
                <label>Title<span class="required">*</span></label>
                <input type="text" name="title" placeholder="Title" value="{SONG_TITLE}">
            </li>
            <li class="clearfix">
                <label>Description<span class="required">*</span></label>
                <textarea name="description" placeholder="Description" value="{SONG_DESCRIPTION}"></textarea>
            </li>
            <li class="clearfix">
                <label>Tags<span class="required">*</span></label>
                <input type="text" name="tags" placeholder="Tags" value="{SONG_TAGS}">
            </li>
            <li class="clearfix">
                <label>Thumbnail file</label>
                <input type="file" name="thumbnail" id="thumbnail" value="{SONG_THUMBNAIL}">
            </li>
            <li class="clearfix">
                <label>&nbsp;</label>
                <input type="submit" class="button" value="update">
            </li>
        </ul>
    </div>
</form>