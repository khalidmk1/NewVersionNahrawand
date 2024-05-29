@extends('layouts.master')

@section('header')
    Create Emails Page
@endsection

@section('page')
    View Profile
@endsection

@section('link')
    {{ route('report.index') }}
@endsection

@section('content')
<div class="row justify-content-center">

    <div class="col-md-9">
        <form action="" method="post">
            @csrf
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Compose New Message</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <div class="form-group">
                        <label>Multiple</label>
                        <select class="select2" name="users[]" multiple="multiple"
                            data-placeholder="Select a State" style="width: 100%;">
                            @foreach ($users as $user)
                                <option value="{{ $user->email }}">{{ $user->email }}</option>
                            @endforeach


                        </select>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <input name="Subject" class="form-control" placeholder="Subject:">
                    </div>
                    <div class="form-group">
                        <textarea name="body" id="compose-textarea" class="form-control" style="height: 300px">
            <h1><u>Heading Of Message</u></h1>
            <h4>Subheading</h4>
            <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
              was born and I will give you a complete account of the system, and expound the actual teachings
              of the great explorer of the truth, the master-builder of human happiness. No one rejects,
              dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
              how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
              is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
              but because occasionally circumstances occur in which toil and pain can procure him some great
              pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
              except to obtain some advantage from it? But who has any right to find fault with a man who
              chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
              produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
              dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
              blinded by desire, that they cannot foresee</p>
            <ul>
              <li>List item one</li>
              <li>List item two</li>
              <li>List item three</li>
              <li>List item four</li>
            </ul>
            <p>Thank you,</p>
            <p>John Doe</p>
          </textarea>
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="float-right">

                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i>
                            Send</button>
                    </div>

                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </form>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
@endsection