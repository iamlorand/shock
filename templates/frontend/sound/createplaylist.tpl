<style type="text/css">
    form, input, textarea{
        width: 250px;
        margin: 2px auto;
    }
    .create{
        width: 50%;
        margin: auto;
    }
</style>
<div class="create">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 style="text-align: center;">Create a playlist:</h3> 
        </div>
        <div class="panel-body">
            <form method="POST" action="">
                <br>
                <input type="text" name="playlistName" placeholder="Playlist name">
                <br>
                <textarea name="description" placeholder="Description"></textarea>
                <br>
                <input type="submit" value="Create">
            </form> 
        </div>
    </div>
</div>