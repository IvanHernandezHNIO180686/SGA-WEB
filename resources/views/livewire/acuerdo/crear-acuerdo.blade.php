<div>
    <div>
        {{-- Campo para registrar el identificador de la reunión --}}
        <label class="form-label" for="reunione_id">Reunion</label>
        <select class="form-input" name="reunione_id" id="idReunion" wire:model='selectedAuditoria'>
            <option value="">==Reunion==</option>
            @foreach ($Reuniones as $reunion)
            <option value="{{ $reunion->id }}">{{ $reunion->NombreReunion }}</option>
            @endforeach
        </select>
        <p class="alert alert-danger" id="IDreunion" style="display: none">¡¡¡Es un campo necesario!!</p>
    </div>
    <div>
        {{-- Campo para registrar la auditoría a la que este acuerdo pertenece --}}
        <label class="form-label" for="Auditoria">Auditoria</label>
        <input class="form-input" type="text" name="Auditoria" id="" value="{{ $SiglasAuditoria }}" readonly><br>
    </div>
    <div>
        {{-- Campo para el Número del acuerdo --}}
        <label class="form-label" for="NumeroAcuerdo">Numero de Acuerdo</label>
        <input class="form-input" type="text" name="NumeroAcuerdo" id="" value="{{ $nombreAcuerdo }}" readonly>
    </div>
    <div>
        {{-- Campo para agregar el nombre del comité encargado de la reunión --}}
        <label class="form-label" for="Comite">Comite</label>
        <input class="form-input" type="text" name="Comite" id="" value="{{ $nombreComite }}" readonly><br>
    </div>
    {{-- Campo para registrar el responsable del acuerdo --}}
    <label class="form-label" for="">Responsable</label>
    @if (!is_null($Comites))
    <div>
        <select class="form-input" name="Responsable" id="Responsable">
            <option value="">==Integrantes==</option>
            @foreach ($Comites as $comite)
            <option value="{{ $comite->SiglasUsuario }}">{{ $comite->Nombres.' '.$comite->ApellidoPaterno.'
                '.$comite->ApellidoMaterno }}</option>
            @endforeach
        </select>
        <p class="alert alert-danger" id="Representante" style="display: none">¡¡¡Es un campo necesario!!</p>
    </div>
    @endif
</div>
