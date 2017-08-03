<style type="text/css">
    .comment textarea{
        width: 100%;
        padding: 5px;
        margin: 5px 0px;
    }
</style>

<div>
    <p>Article #{ARTICLE_ID} | Published: {ARTICLE_DATE}</p>
    <hr>
    <p>{ARTICLE_CONTENT}</p>
    <button><a href="{SITE_URL}/article/list/">Go Back</a></button>
</div>


<!-- BEGIN comment -->

<form class="comment" method="POST" action="">
    <textarea placeholder="comment here..."></textarea>
    <button type="submit">Comment</button>
</form>

<!-- END comment -->