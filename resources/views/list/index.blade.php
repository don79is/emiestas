@extends('layouts.app')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 ">
                @if (session('message'))
                    <div class="alert alert-info">{{ session('message') }}</div>
                @endif
                @if (session('message-delete'))
                    <div class="alert alert-danger">{{ session('message-delete') }}</div>
                @endif
                <div class="panel panel-primary">

                    <div class="panel-heading">
                       VISAS SĄRAŠAS
                        <form action="{{route('list.index')}}" method="get" class="form-inline">
                            <div class="form-group">
                                <input class="form-control" type="text" name="s" value="{{isset($s) ? $s : ''}}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Paieška</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-info panel full screen">
                    <table class="table table-bordered">
                        <thead class="active">
                        <tr>
                            <th>Pažymėti visus
                                <input type="checkbox" class="checkbox_all"></th>
                            <th>Gimimo Metai</th>
                            <th>Gimimo_valstybe</th>
                            <th>Lytis</th>
                            <th>Seimos_padetis</th>
                            <th>Kiek_turi_vaiku</th>
                            <th>Seniunija</th>
                            <th>Gatve</th>
                            <th>Seniunnr</th>
                            <th>Ter_rej_kodas</th>
                            <th>Gatv_k</th>
                            <th>Gat_id</th>
                            <th>Veiksmai</th>
                            @if(isset($edit))
                                <th> Koreguoti</th>
                            @endif
                            @if(isset($delete))
                                <th> Trinti</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($peoples as $people)
                            <tr>
                                <td><input type="checkbox" class="checkbox_delete"
                                           name="entries_to_delete[]" value="{{$people->id}}"/></td>
                                <td>{{ $people->gimimo_metai}}</td>
                                <td>{{ $people->gimimo_valstybe}}</td>
                                <td>{{ $people->lytis}}</td>
                                <td>{{ $people->seimos_padetis}}</td>
                                <td>{{ $people->kiek_turi_vaiku}}</td>
                                <td>{{ $people->seniunija}}</td>
                                <td>{{ $people->gatve}}</td>
                                <td>{{ $people->seniunnr}}</td>
                                <td>{{ $people->ter_rej_kodas}}</td>
                                <td>{{ $people->gatv_k}}</td>
                                <td>{{ $people->gat_id}}</td>



                                <td>
                                    <a href="{{ route('list.edit', $people->id) }}"
                                       class="btn btn-success btn-sm">Koreguoti</a>
                                </td>
                                <td>
                                    <form action="{{route('list.destroy', $people->id)}}" method="POST"
                                          style="display: inline"
                                          onsubmit="return confirm('Ar jūs tikria norite ištrinti įrašą?');">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Įrašų nerasta.</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                    <form action="{{ route('list.mass_destroy') }}" method="post"
                          onsubmit="return confirm('Ar jūs tikria norite ištrinti visus įrašus?');">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="ids" id="ids" value=""/>
                        <input type="submit" value="Ištrinti pažymėtus" class="btn btn-danger"/>
                    </form>
                    {!! $peoples->appends(['s' => $s])->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        function getIDs() {
            var ids = [];
            $('.checkbox_delete').each(function () {
                if ($(this).is(":checked")) {
                    ids.push($(this).val());
                }
            });
            $('#ids').val(ids.join());
        }

        $(".checkbox_all").click(function () {
            $('input.checkbox_delete').prop('checked', this.checked);
        });
        $('.checkbox_delete').change(function () {
            getIDs();
        });
    </script>
@endsection