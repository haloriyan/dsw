@extends('layouts.admin')

@section('title', 'FAQ')

@section('breadcrumb')
{{-- <li><a href="#">Dashboard</a></li>
<li><a href="#">Master Data</a></li>
<li class="active">FAQ</li> --}}
<button class="btn btn-primary" data-toggle="modal" data-target="#scrollmodal"><i class="fas fa-plus"></i> &nbsp; New FAQ</button>
@endsection

@section('content')
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($faqs as $faq)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $faq->question }}</td>
                                <td>{{ $faq->answer }}</td>
                                <td class="text-center">
                                    <a href="#" class="text-danger" data-faq="{{ json_encode($faq) }}" data-toggle="modal" data-target="#deleteModal" id="deleteBtn">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    &nbsp; &nbsp;
                                    <a href="#" data-faq="{{ json_encode($faq) }}" class="text-primary" data-toggle="modal" data-target="#editModal" id="editBtn">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ route('faq.delete') }}" class="modal-content" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="faq_id" id="faq_id_delete">
                <div class="modal-header">
                    <h5 class="modal-title float-left" id="scrollmodalLabel">Hapus Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Yakin ingin menghapus FAQ ini?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ route('faq.update') }}" class="modal-content" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="faq_id" id="faq_id">
                <div class="modal-header">
                    <h5 class="modal-title float-left" id="scrollmodalLabel">Edit Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pertanyaanEdit">Pertanyaan :</label>
                        <input type="text" class="form-control" id="questionEdit" name="question">
                    </div>
                    <div class="form-group">
                        <label for="pertanyaanEdit">Jawaban :</label>
                        <textarea name="answer" id="answerEdit" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <form action="{{ route('faq.store') }}" class="modal-content" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title float-left" id="scrollmodalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="question">Pertanyaan :</label>
                        <input type="text" class="form-control" name="question" required id="question">
                    </div>
                    <div class="form-group">
                        <label for="answer">Jawaban :</label>
                        <textarea name="answer" id="answer" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
<script>
    (function($) {
        $(document).on("click", "#editBtn", function() {
            let data = $(this).data('faq')
            $("#faq_id").val(data.id)
            $("#questionEdit").val(data.question)
            $("#answerEdit").val(data.answer)
        })
        $(document).on("click", "#deleteBtn", function() {

 let data = $(this).data('faq')
            $("#faq_id_delete").val(data.id)
        })
    })(jQuery)
</script>
@endsection
