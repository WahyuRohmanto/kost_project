@extends('admin.index')
@section('content')
@php
$title = ['No', 'Kode Bayar','Kost', 'Customer', 'Tanggal Masuk', 'Tanggal Keluar', 'Total Bayar', 'Status Pembayaran',
'Action'];
@endphp
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="wrapper">
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <ul class="breadcrumbs">
                        <li class="nav-home">
                            <a href="#">
                                <i class="flaticon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Master Data</a>
                        </li>
                        <li class="separator">
                            <i class="flaticon-right-arrow"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">Pembayaran</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Table Pembayaran</h4>
                                    <a title="Export to PDF" href="{{url('pembayaran-pdf')}}"
                                        class="btn btn-danger btn-round ml-auto text-light">
                                        <span class="btn-label">
                                            <i class="fas fa-file-pdf"></i>
                                        </span>
                                        Export
                                    </a>

                                    <a title="Export to Excel" href="{{url('pembayaran-excel')}}"
                                        class="btn btn-success btn-round ml-2 text-light">
                                        <span class="btn-label">
                                            <i class="fa fa-print"></i>
                                        </span>
                                        Print
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Modal -->
                                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header no-bd">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">
                                                        New</span>
                                                    <span class="fw-light">
                                                        Row
                                                    </span>
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="small">Create a new row using this form, make sure you
                                                    fill them all</p>
                                                <form>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input id="addName" type="text" class="form-control"
                                                                    placeholder="fill name">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 pr-0">
                                                            <div class="form-group form-group-default">
                                                                <label>Position</label>
                                                                <input id="addPosition" type="text" class="form-control"
                                                                    placeholder="fill position">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group form-group-default">
                                                                <label>Office</label>
                                                                <input id="addOffice" type="text" class="form-control"
                                                                    placeholder="fill office">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer no-bd">
                                                <button type="button" id="addRowButton"
                                                    class="btn btn-primary">Add</button>
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table id="add-row" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                @foreach($title as $tt)
                                                <th>{{$tt}}</th>
                                                @endforeach
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                            $no = 1;
                                            @endphp
                                            @foreach($pembayaran as $fs)
                                            <tr>
                                                <td>{{$no++}}
                                                <td>{{$fs['kode_bayar']}}</td>
                                                <td>{{$fs['id_kamar']}}</td>
                                                <td>{{$fs['id_user']}}</td>
                                                <td>{{$fs['tanggal_masuk']}}</td>
                                                <td>{{$fs['tanggal_keluar']}}</td>
                                                <td>Rp. {{number_format($fs['total_bayar'], 2,',', '.')}}</td>
                                                @if($fs->status_pembayaran === "diproses")
                                                <td>
                                                    <p style="border-radius: 500px;"
                                                        class="px-1  fw-bold text-center btn-warning text-light">
                                                        {{$fs->status_pembayaran}}</p>
                                                </td>
                                                @elseif($fs->status_pembayaran === "success")
                                                <td>
                                                    <p style="border-radius: 500px;"
                                                        class="px-1  fw-bold text-center btn-success text-light">
                                                        {{$fs->status_pembayaran}}</p>
                                                </td>
                                                @else
                                                <td>
                                                    <p style="border-radius: 500px;"
                                                        class="px-1  fw-bold text-center btn-danger text-light">
                                                        {{$fs->status_pembayaran}}</p>
                                                </td>
                                                @endif
                                                <td
                                                    style="display: flex; flex-directon: row; justify-content: center; align-item: center;">
                                                    {{-- konfirmasi status pembayaran --}}
                                                    {{-- terima --}}
                                                    <form method="POST" action="{{route('pembayaran.update', $fs->id)}}"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <input name="status_pembayaran" hidden value="success"
                                                            type="text" />
                                                        <button type="submit" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="terima pesanan"><i
                                                                class="bi bi-check2-all"></i></button>
                                                    </form>
                                                    {{-- tolak --}}
                                                    <form method="POST" action="{{route('pembayaran.update', $fs->id)}}"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <input name="status_pembayaran" hidden value="dibatalkan"
                                                            type="text" />
                                                        <button type="submit" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-danger btn-lg"
                                                            data-original-title="tolak pesanan"><i
                                                                class="bi bi-backspace-reverse"></i></button>
                                                    </form>
                                                    {{-- diproses --}}
                                                    <form method="POST" action="{{route('pembayaran.update', $fs->id)}}"
                                                        enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <input name="status_pembayaran" hidden value="diproses"
                                                            type="text" />
                                                        <button type="submit" data-toggle="tooltip" title=""
                                                            class="btn btn-link btn-warning btn-lg"
                                                            data-original-title="proses pesanan"><i
                                                                class="bi bi-arrow-clockwise"></i></button>
                                                    </form>
                                                    {{-- end status --}}
                                                    {{-- action detail & delete --}}
                                                    <form method="POST"
                                                        action="{{route('pembayaran.destroy', $fs->id)}}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="form-button-action">
                                                            <a href="{{ route('pembayaran.show',$fs->id) }}"
                                                                data-toggle="tooltip" title=""
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="View Detail">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <button name="_method" type="button" data-toggle="tooltip"
                                                                title=""
                                                                class="btn btn-link btn-danger delete-confirm show_confirm"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.footer')
    </div>

    <!-- Custom template | don't include it in your project! -->

    <!-- Custom template | don't include it in your project! -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form = $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        swal({
                title: `Yakin akan menghapus data pembayaran?`,
                text: "Data akan dihapus secara permanent!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
    </script>
    <!-- End Custom template -->
</div>
@endsection