<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <form action="" method="POST">
    Search: <input type="text" name="search" placeholder=" Search here ... "/>
    <input type="submit" value="Submit" />
    </form> 


    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center; width: 20px;">#</th>
                <th>THUMBNAIL</th>
                <th>TITLE</th>
                <th>Share </th>
                <th>PREVIEW</th>
                <th>VIEWCOUNT</th>
                <th width="230px">Action</th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN list_music -->
            <tr>
                <td style="text-align: center;">{ID}</td>
                <td style="width: 50px;"><img src="{SITE_URL}/{THUMBNAIL}" style="width: 100px; height: auto;"></td>
                <td><a href="{SITE_URL}/sound/show_song/id/{ID}">{TITLE}</a></td>
                <td>
                    <table  class="action_table">
                            <tr>
                                <td width="25%" >
                                    <a href="https://www.facebook.com/login.php?login_attempt=1&lwv=110"><i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i></a>
                                    </a>
                                </td>
                                <td width="25%">
                                  <a href="https://twitter.com/login/error?redirect_after_login=%2Fsearch-home"><i class="fa fa-twitter-square fa-2x" aria-hidden="true"></i></a>
                               </td>
                                <td width="25%" >
                                   <a href="https://www.linkedin.com/uas/login"><i class="fa fa-linkedin-square fa-2x" aria-hidden="true"></i></a>
                                    </a>
                                </td>
                                 <td width="25%" >
                                   <a href="https://login.yahoo.com/?.src=ym&.intl=us&.lang=en-US&authMechanism=primary&yid=&done=https%3A%2F%2Fmail.yahoo.com%2F&eid=100&add=1"><i class="fa fa-envelope-square fa-2x" aria-hidden="true"></i></a>
                                    </a>
                                </td>
                            </tr>
                        </table>
                </td>
                <td>
                    <audio controls>
                        <source src="{SITE_URL}/{FILENAME}" type="audio/mpeg">
                    </audio>
                </td>
                <td>{VIEWCOUNT}</td>
                <td>
                    <table  class="action_table">
                        <tr>
                            <td width="25%">
                                <button class="btn btn-default btn-sm">
                                    <a href="{SITE_URL}/sound/update/id/{ID}" title="Edit/Update" class="edit_state">Edit</a>
                                </button>
                            </td>
                            <td width="25%">
                                <button class="btn btn-default btn-sm">
                                    <a href="{SITE_URL}/sound/delete/id/{ID}" title="Delete" class="delete_state">Delete</a>
                                </button>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <!-- END list_music -->
        </tbody>
    </table>
</div>
{PAGINATION}
