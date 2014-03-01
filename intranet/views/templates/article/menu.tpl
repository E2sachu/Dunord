<div class="panel panel-default">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="input-group input-group-sm">
                <input type="text" id="articleSearchText" class="form-control" placeholder="Titre ...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id='articleSearchBtn'><i class="fa fa-search"></i></button>
                </span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="btn-group">
                <button type="button" class="btn btn-default" id="articleSearchPublished">Publié</button>
                <button type="button" class="btn btn-default" id="articleSearchUnpublished">Non publié</button>
            </div>
        </li>
    </ul>
</div>

<script language='javascript'>
$(document).ready(function(){
    $('#articleSearchBtn').click(function(){
        var text = $('#articleSearchText').val();
        getContent($('#content'), 'article/search', {
            needle:text
        });
    });
    $('#articleSearchPublished').click(function(){
        getContent($('#content'), 'article/searchPublished');
    });
    $('#articleSearchUnpublished').click(function(){
        getContent($('#content'), 'article/searchUnpublished');
    });
});
</script>