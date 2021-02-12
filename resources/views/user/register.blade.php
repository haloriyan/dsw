@extends('layouts.authUser')

@section('title', "Register - Data Science Weekends")

@section('content')
<form action="{{ route('user.register') }}" method="POST">
    {{ csrf_field() }}
    @if ($errors->count() > 0)
        @foreach ($errors->all() as $err)
            <div class="bg-merah-transparan rounded p-2">
                {{ $err }}
            </div>
        @endforeach
    @endif
    <div class="mt-2">Nama :</div>
    <input type="text" class="box" name="name" required>
    <div class="mt-2">Email :</div>
    <input type="email" class="box" name="email" required>
    <div class="mt-2">Password :</div>
    <input type="password" class="box" name="password" required>
    <div class="mt-2">No. Telepon :</div>
    <input type="text" class="box" name="phone" required>
    <div class="mt-2">Instansi/Universitas :</div>
    <input type="text" class="box" name="instance" required>
    <div class="mt-2">Jenis kelamin :</div>
    <select name="gender" class="box" required>
        <option value="">-- PILIH --</option>
        <option>Laki-laki</option>
        <option>Perempuan</option>
    </select>
    <div class="mt-2">Status :</div>
    <select name="employment_status" class="box">
        <option value="">-- PILIH --</option>
        <option>Bekerja</option>
        <option>Mahasiswa</option>
        <option>Pelajar</option>
    </select>
    <div class="mt-2">Kenapa kamu ingin ikut event DSW ini?</div>
    <textarea name="reason" rows="10" required class="box"></textarea>
    <div class="mt-2">Sudah bergabung dengan DSI?</div>
    <select name="has_joined_dsi" class="box" onchange="hasJoined(this.value)" required>
        <option value="">-- PILIH --</option>
        <option value="0">Belum</option>
        <option value="1">Sudah</option>
    </select>
    <div id="interestedArea" class="d-none">
        <div class="mt-2">Tertarik bergabung dengan DSI?</div>
        <select name="interested_with_dsi" class="box">
            <option value="" selected>-- PILIH --</option>
            <option value="1">Ya, saya tertarik</option>
            <option value="0">Tidak</option>
        </select>
    </div>

    <button class="lebar-100 primer mt-3">Register</button>

    <div class="rata-tengah mt-3">
        sudah punya akun? <a href="{{ route('user.loginPage') }}">login</a> sekarang
    </div>
</form>
@endsection

@section('javascript')
<script>
    const hasJoined = i => {
        if (i == 0) {
            select("#interestedArea").style.display = "block";
            select("#interestedArea option[value='1']").setAttribute('selected', 'selected');
        }else {
            select("#interestedArea").style.display = "none";
            select("#interestedArea option[value='']").setAttribute('selected', 'selected');
        }
    }
</script>
@endsection