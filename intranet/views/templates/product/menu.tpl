<div class="panel panel-default">
    <ul class="list-group">
        <li class="list-group-item product">Produit</li>
        <li class="list-group-item coupon">Coupon</li>
    </ul>
</div>

<script language='javascript'>
$(document).ready(function(){
    $('.list-group-item.product').click(function(){
        reload('product/home');
    });
    $('.list-group-item.coupon').click(function(){
        reload('coupon/home');
    });    
})
</script>