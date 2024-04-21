
<div 
class="container-fluid">
    <h6 class="mb-4">Cập nhật thông tin</h6>
    <form class="form" action="" method="post">
        <div class="row">
            @csrf
            @method('put')
          
            <div class="col-lg-12 mb-3">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here"
                        id="floatingTextarea" name="address" autocomplete="address" rows="2"></textarea>
                    <label for="floatingTextarea">Địa chỉ</label>
                </div>
            </div>
            <div 
            class="col-lg-12">
                <button class="btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
        
</div>