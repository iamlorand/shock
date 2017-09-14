<style type="text/css">
  #submitUpload {
  background-color: #ff471a;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#31b2c3), to(#ff3300));
  background-image: -webkit-linear-gradient(top, #ff471a, #ff8566);
  background-image: -moz-linear-gradient(top, #ff471a, #ff8566);
  background-image: -ms-linear-gradient(top, #ff471a, #ff8566);
  background-image: -o-linear-gradient(top, #ff471a, #ff8566);
  background-image: linear-gradient(top, #ff471a, #ff8566);
  border: 1px solid #00748f;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
  -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
  box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
  color: #fafafa;
  cursor: pointer;
  height: 30px;
  font: 15px Arial, Helvetica;
  padding: 0;
  text-shadow: 0 1px 0 rgba(0, 0 ,0, .3);
  width: 100px;
}
 #submitUpload:hover,
 #submitUpload:focus {
  background-color: #31b2c3;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#0483a0), to(#31b2c3));
  background-image: -webkit-linear-gradient(top,  #ff9980,  #b32400);
  background-image: -moz-linear-gradient(top, #0483a0, #b32400);
  background-image: -ms-linear-gradient(top, #0483a0, #b32400);
  background-image: -o-linear-gradient(top, #0483a0, #b32400);
  background-image: linear-gradient(top, #0483a0,  #b32400);
}
#submitUpload:active {
  -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
  -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
  outline: 0;
 #submitUpload::-moz-focus-inner {
  border: 0;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{TEMPLATES_URL}/css/frontend/update.css">

    <form  method="POST" action="" enctype="multipart/form-data">
            <h2>Select a song to upload:</h2>
            <ul class="form">
                <li class="clearfix">
                    <input id="file" type="file" name="fileToUpload" id="fileToUpload">
                </li>
                <li class="clearfix">
                    <label for="title" >Title:</label>
                    <input type="text" id="title" name="title" placeholder="Title">
                </li>
                 <li class="clearfix">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" placeholder="describe the song"></textarea>
                </li>
                <li class="clearfix">
                    <label for="genre">Genre</label>
                        <select name="genre">
                            <option>Select a genre</option>
                            <option value="all">All</option>
                            <!-- BEGIN genre_list -->
                            <option value="{GENRE}">{GENRE}</option>
                            <!-- END genre_list -->
                        </select>
                </li>
                <li class="clearfix">
                    <label for="thumbnail"> Thumbnail:
                    <input type="file" id="thumbnail" name="thumbnail" id="thumbnail">
                </li>
                <li class="clearfix">
                    <input type="submit" id="submitUpload" value="Upload File">
                </li>

            </ul> 
    </form> 
