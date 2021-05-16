<div class="card">
    <div class="card-action grey lighten-4">
        <h3 class="card-title">
            Informasi Praktikum
        </h3>
    </div>

    <div class="card-content">
        @if ($cs->type == 'KTI')
            <div class="input-field">
                <input type="text" name="theme" id="theme" required />
                <label for="theme">Judul Penelitian</label>
            </div>
        @endif

        <div class="input-field">
            <input type="text" name="lecturer" id="lecturer" required />
            <label for="lecturer">Dosen Pengampu / Pembimbing</label>
        </div>

        <div class="input-field">
            <select name="laboratory" id="laboratory" disabled required>
                <option value="" id="laboratory-default" disabled>Pilih Laboratorium</option>
                @foreach ($laboratories as $laboratory)
                    <option 
                        value="{{ $laboratory->id }}" 
                        @if ($practice->laboratory == $laboratory->id)
                            selected
                        @endif
                    >{{ $laboratory->name }}</option>
                @endforeach
            </select>
            <label for="laboratory">Laboratorium</label>
        </div>

        <div class="input-field">
            <select name="course" id="course" disabled required>
                <option value="" id="course-default" disabled selected>Pilih Mata Kuliah Praktikum</option>
                @foreach ($courses as $course)
                    <option 
                        value="{{ $course->id }}"
                        @if ($practice->course == $course->id)
                            selected
                        @endif
                    >{{ $course->code }} - {{ $course->name }}</option>
                @endforeach
            </select>
            <label for="course">Mata Kuliah Praktikum</label>
        </div>

        <div class="input-field">
            <input type="hidden" name="laboratory" id="laboratory-input" value="{{ $practice->laboratory }}">
            <input type="hidden" name="course" id="course-input" value="{{ $practice->course }}">
        </div>

        <div class="input-field">
            <input type="date" name="date" id="date" value="{{ $practice->date }}" readonly required />
            <label for="date">Tanggal Praktikum</label>
        </div>

        <div class="input-field">
            <input type="time" name="time" id="time" value="{{ $practice->time }}" readonly required />
            <label for="time">Waktu Mulai Praktikum</label>
        </div>
    </div>
</div>