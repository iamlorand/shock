{PAGINATION}
<div id="adminList" class="box-shadow">
    <table class="big_table" frame="box" rules="all">
        <thead>
            <tr>
                <th style="text-align: center; width: 20px;"><span>#</span></th>
                <th><span>Article Content</span></th>
                <th><span>Date</span></th>
                <th width="300px"><span>Action</span></th>
            </tr>
        </thead>
        <tbody>
        <!-- BEGIN article_list -->
            <tr>
                <td style="text-align: center;">{ARTICLE_ID}</td>
                <td><a href="{SITE_URL}/admin/article/show/id/{ARTICLE_ID}">{ARTICLE_CONTENT}</a> </td>
                <td>{ARTICLE_DATE}</td>
                <td>
                    <table class="action_table">
                        <tr>
                            <td width="20%"><a href="{SITE_URL}/admin/article/edit/id/{ARTICLE_ID}/" title="Edit/Update" class="edit_state">Edit</a></td>
                            <td width="25%"><a href="{SITE_URL}/admin/article/delete/id/{ARTICLE_ID}/" title="Delete" class="delete_state">Delete</a></td>
                        </tr>
                    </table>
                </td>
            </tr>
        <!-- END article_list -->
        </tbody>
    </table>
</div>