<table id="price4" class="table table-default table-bordered table-price text-center bg-white">
    <tbody>
        <tr>
            <th>Volume:</th>
            <td class="in-stock active"><input type="radio" name="buy[4]" value="4"> spiral diary</td>
        </tr>
        <tr>
            <th>Price:</th>
            <td class="active">Rs.4258.00<div class="available in-stock text-success d-none" rel="Buy"><i class="fa fa-check"></i> In stock</div>
            </td>
        </tr>
    </tbody>
</table>
<button class="btn btn-primary btn-block btn-buy" rel="price?= $model->id ?>">
    <= $available > 0 ? Yii::t('app', 'Buy') : Yii::t('app', 'To order') ?>
</button>
<!-- ============================================ -->
<div id="feature-pjax" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
    <h5>Size</h5>
    <div class="card card-outline p-4">
        <div><input type="radio" id="buy[28][8]0" class="btn-check" name="buy[28][8]" value="0" title="click" autocomplete="off"><label class="btn btn-outline-success" for="buy[28][8]0"><i class="bi bi-circle pe-2"></i>6 Inch - Not Available</label>
            <input type="radio" id="buy[28][8]1" class="btn-check" name="buy[28][8]" value="786" title="click" autocomplete="off"><label class="btn btn-outline-success" for="buy[28][8]1"><i class="bi bi-circle pe-2"></i>12 Inch -1 Piece @ ₹786/- Only</label>
        </div>
    </div>
    <h5>Version</h5>
    <div class="card card-outline p-4">
        <div><input type="radio" id="buy[28][9]0" class="btn-check" name="buy[28][9]" value="1000" title="click" autocomplete="off"><label class="btn btn-outline-success" for="buy[28][9]0"><i class="bi bi-circle pe-2"></i>Eggless -1 Piece @ ₹1000/- Only</label>
            <input type="radio" id="buy[28][9]1" class="btn-check" name="buy[28][9]" value="647" title="click" autocomplete="off"><label class="btn btn-outline-success" for="buy[28][9]1"><i class="bi bi-circle pe-2"></i>With Egg -1 Piece @ ₹647/- Only</label>
        </div>
    </div>
</div>
<!-- ============================================= -->
$js = <<< JS
                var eq = 0;
                $('.featSel').each(function(index){
                    var obj = $(this).parents('div');
                    $(this).find('div').mouseenter(function(){
                        var i = $(this).index();
                        obj.find('.card').each(function(){
                            $(this).find('i').eq(i-1).addClass('bi-circle-fill');
                        });
                    }).mouseleave(function(){
                        var i = $(this).index();
                        obj.find('.card').each(function(){
                            $(this).find('i').eq(i-1).removeClass('bi-circle-fill');
                        });
                    }).click(function(){
                        var i = $(this).index();
                        obj.find('tr').each(function(index3){
                            $(this).find('input').prop('checked', false);
                            $(this).find('td').removeClass('active').eq(i-1).each(function(){
                                if (index3) {
                                    var oo = obj.closest('.row').parent().closest('.row');
                                    var o = $(this).find('.available');
                                    if (o.hasClass('not-available')) {
                                        oo.find('.btn-buy').hide();
                                    } else if (o.hasClass('in-stock')) {
                                        oo.find('.btn-buy').show().text(o.attr('rel'));
                                    } else if (o.hasClass('on-order')) {
                                        oo.find('.btn-buy').show().text(o.attr('rel'));
                                    }
                                    oo.find('.stock').html(o.clone().removeClass('d-none'));
                                }
                            }).addClass('active').find('input').prop('checked', true);
                        });
                    }).each(function(index2){
                        if (!index && !eq && $(this).hasClass('in-stock')) {
                            eq = index2;
                            return false;
                        }
                    }).eq(eq).addClass('active').find('input').prop('checked', true);
                    if (index) {
                        eq = 0;
                    }
                });
                $('.btn-buy').mousedown(function(){
                    var id = $('#' + $(this).attr('rel') + ' input:checked').val();
                    $.get('{$url_add}', { id: id }, function(){
                        //openModal('{$url_cart_modal}');
                        openOffCanvas('{$url_cart_modal}');
                    });
                });
        JS;

        
        var eq = 0;  
                $('.featSel').each(function(index){
                    var obj = $(this).parents('div');
                    console.log(obj.attr('id'));
                   /* obj.find('input').prop('checked',true).each(function(index){
                          console.log($(this).val());
                    });*/
                    $("input:radio[name='choices']:checked").val();
                    obj.find('.fsel').mouseenter(function(){
                            var i = $(this).index();                                                          
                            $(this).find('i').removeClass('bi-circle');
                            $(this).find('i').addClass('bi-check-circle');
                    }).mouseleave(function(){                     
                            var i = $(this).index(); 
                            

                            //console.log(ev.target, name,val);
                         //    $(ev.target).prop('checked', true);   
                           // console.log($(this).find('input').prop('checked', false).val());
                          
                    });    
            });     