@extends('landingpage.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @include('landingpage.sidebar')
        <div class="col-10 p-5" id="main">
            <a title="Export to PDF" href="{{url('kost-pdf-pemilik')}}"
                class="btn btn-export btn-outline mb-3 text-light">
                <span class="btn-label">
                    <i class="fas fa-file-pdf"></i>
                </span>
                Export
            </a>
            <a title="Export to PDF" href="{{url('kost-excel-pemilik')}}"
                class="btn ml-2 btn-print btn-outline mb-3 text-light">
                <span class="btn-label">
                    <i class="fa fa-print"></i>
                </span>
                Print
            </a>
            <a title="Add Kost" href="{{url('addKost')}}" class="btn ml-2 btn-add btn-outline mb-3 text-light">
                <span class="btn-label">
                    <i class="fa fa-plus"></i>
                </span>
                Add
            </a>
            <table class="table table-hover">
                <thead style=" background-color: #11296b;">
                    <tr class="text-light">
                        <th>Pemilik Kost</th>
                        <th>Nama Kost</th>
                        <th>Luas Kamar</th>
                        <th>Harga</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemilik_kost as $pk)
                    @if($pk->id_user === Auth::user()->id)
                    <tr>
                        <td>{{$pk->name}}</td>
                        <td>{{$pk->nama_kost}}</td>
                        <td>{{$pk->luas_kamar}}</td>
                        <td>Rp {{number_format($pk->harga_kamar, 0, ',', '. ')}}</td>
                        <td style="width: 20%;">
                            <div class="form-button-action">
                                <a href="{{ route('data-pemilik.show', $pk->id) }}" type="button" data-toggle="tooltip"
                                    style="color: #11296b;" title="Detail" class="btn btn-link btn-lg"
                                    data-original-title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('data-pemilik.edit', $pk->unique_id) }}" type="button"
                                    data-toggle="tooltip" style="color: #fd5f00;" title="Edit"
                                    class="btn btn-link btn-lg" data-original-title="Edit Task">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <!-- Add Delete Button with Form -->
                                <form action="{{ route('data-pemilik.destroy', $pk->unique_id) }}" method="POST"
                                    style="display: inline;" onsubmit="return confirm('Ingin Menghapus Kost Ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link btn-lg" style="color: #ff0000;"
                                        title="Delete" data-toggle="tooltip" data-original-title="Delete">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection