<div class="row grey lighten-5">
    <form action="/professors/search" class="col s12" method="POST" role="search" >
        {{ csrf_field() }}    
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s12 l6" style="margin: 0px; margin-top: 10px;">
                <i id="search-icon" class="material-icons grey-text prefix">face</i>
                <input id="search" type="text" class="validate grey-text text-darken-2" name="q" value="{{ old('q') }}" type="search" minlength="3" maxlength="30" required>
                <label for="search">Faculty Name/Initials:</label>                
            </div>
        
            <div class="input-field col s6 push-s2 l4" style="margin: 0px; margin-top: 10px;">
                <select name="university_id" id="professor-university" required>
                    <option value="" disabled>Select university</option>
                    @foreach($universities as $university)
                        @if(old('university_id') == $university->id)
                        <option value="{{ $university->id }}" selected>{{ $university->name }}</option>
                        @else
                        <option value="{{ $university->id }}">{{ $university->name }}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="input-field col s4 l1 right-align" style="margin: 0px; margin-top: 10px;">
                <button type="submit" class="waves-effect waves-light btn blue darken-4"><span class="lime-text text-lighten-3"><i class="material-icons">search</i></span></button>
            </div>
        </div>
    </form>
</div>
    