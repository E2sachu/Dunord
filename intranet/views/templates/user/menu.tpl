<div class="panel panel-default">
    <ul class="list-group">
        <li class="list-group-item">
            <div class="input-group input-group-sm">
                <input type="text" id="userSearchText" class="form-control" placeholder="Mail - Nom - Prénom">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id='userSearchBtn'><i class="fa fa-search"></i></button>
                </span>
            </div>
        </li>
         <li class="list-group-item">
            <div class="input-group input-group-sm">
                <input type="text" id="companySearchText" class="form-control" placeholder="Raison social">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id='companySearchBtn'><i class="fa fa-search"></i></button>
                </span>
            </div>
        </li>
        <li class="list-group-item">
            <div class="btn-group">
                <button type="button" class="btn btn-default" id="userSearchLocked">Locked</button>
                <button type="button" class="btn btn-default" id="userSearchUnlocked">Unlocked</button>
            </div>
        </li>
         <li class="list-group-item">
            <div class="btn-group">
                <button type="button" class="btn btn-default" id="userSearchActived">Active</button>
                <button type="button" class="btn btn-default" id="userSearchUnactived">Inactive</button>
            </div>
        </li>
        <li class="list-group-item">
            <div class="btn-group">
                <button type="button" class="btn btn-default" id="getCompagny"> Afficher Recruteur</button>
            </div>
        </li>
    </ul>
</div>

<script language='javascript'>
$(document).ready(function(){
    $('#userSearchBtn').click(function(){
        var text = $('#userSearchText').val();
        getContent($('#content'), 'user/search', {
            needle:text
        });
    });
    $('#companySearchBtn').click(function(){
        var text = $('#companySearchText').val();
        getContent($('#content'), 'company/search', {
            needle:text
        });
    });
    $('#getCompagny').click(function(){
        getContent($('#content'), 'user/searchRecruiter');
    });
    $('#userSearchLocked').click(function(){
        getContent($('#content'), 'user/searchLocked');
    });
    $('#userSearchUnlocked').click(function(){
       getContent($('#content'), 'user/searchUnlocked'); 
    });
    $('#userSearchActived').click(function(){
        getContent($('#content'), 'user/searchActived');
    });
    $('#userSearchUnactived').click(function(){
        getContent($('#content'), 'user/searchUnactived');
    });
});
</script>