<!-- Default box -->
<div class="card card-solid">
    <div class="card-header">

        <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" id="search_admin" name="table_search" class="form-control float-right"
                    placeholder="Nom">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
    <div class="card-body pb-2">
        @yield('card-detail-content')
    </div>


    <!-- /.card-body -->
     <div class="card-footer">
        <nav aria-label="Contacts Page Navigation">
            <ul class="pagination justify-content-center m-0">
                <li class="page-item ">@yield('paginate-detail-card')</li>

            </ul>
        </nav>
    </div>
    <!-- /.card-footer -->
</div>
