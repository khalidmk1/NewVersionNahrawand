@foreach ($notifications as $notification)
    <div class="col-lg-12 right">
        <div class="box shadow-sm rounded bg-dark">
            <div class="box-body p-0">
                <div
                    class="p-3 d-flex {{ $notification->read_at ? '' : 'bg-white' }} align-items-center border-bottom osahan-post-header">
                    <div class="font-weight-bold mr-3">
                        <div class="text-truncate">{{ $notification->data['itemMessage'] }}</div>
                        <div class="small">{{ $notification->data['itemTitle'] }}</div>
                    </div>
                    <span class="ml-auto mb-auto text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm rounded" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form action="{{ route('notification.delete', Crypt::encrypt($notification->id)) }}"
                                    method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                <form action="{{ route('notification.read', Crypt::encrypt($notification->id)) }}"
                                    method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fa fa-times" aria-hidden="true"></i> Mark as Read
                                    </button>
                                </form>
                            </div>
                        </div>
                        <br />
                        <div class="text-right text-muted pt-1">{{ $notification->created_at->diffForHumans() }}</div>
                    </span>
                </div>
            </div>
        </div>
    </div>
@endforeach
