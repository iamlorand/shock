<div id="adminList" class="box-shadow">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="text-align: center; width: 20px;">#</th>
                <th>THUMBNAIL</th>
                <th>TITLE</th>
                <th>PREVIEW</th>
                <th>VIEWCOUNT</th>
                <th width="230px">Action</th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN list_music -->
            <tr>
                <td style="text-align: center;">{ID}</td>
                <td style="width: 50px;"><img src="{SITE_URL}/{THUMBNAIL}" style="width: 25px; height: 25px"></td>
                <td><a href="{SITE_URL}/sound/show_song/id/{ID}">{TITLE}</a></td>
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