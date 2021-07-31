<div class="row valign-wrapper" style="background-image: url({{ asset('img/searchbar_background.png') }}); background-size: cover;">
    <form action="/professors/search" class="col s12" method="POST" role="search" >
        {{ csrf_field() }}    
        <div class="row" style="margin-top: 20px;">
            <div class="input-field col s12 l6" style="margin: 0px; ">
                <i id="search-icon" class="material-icons red-text prefix">school</i>
                <input id="search" type="text" class="validate grey-text text-darken-2" name="q" value="{{ old('q') }}" type="search" minlength="3" maxlength="30" required  onkeyup="EnableDisable()">
                <label for="search">Teacher Name/Initials:</label>                
            </div>
        
            <div class="input-field col s6 push-s2 l4" style="margin: 0px; margin-top: 10px;">
                <select name="university_id" id="professor-university" required>
                    <option value="" disabled>Select university</option>
                    @foreach($universities as $university)
                        @if(old('university_id') == $university->id)
                        <option value="{{ $university->id }}" selected>{{ $university->abbr }}</option>
                        @else
                        <option value="{{ $university->id }}">{{ $university->abbr }}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="input-field col s4 l1 right-align" style="margin: 0px; margin-top: 10px;">
                <button id="btnSubmit" type="submit" class="waves-effect waves-light btn red lighten-1"><span class="grey-text text-lighten-3"><i class="material-icons">search</i></span></button>
            </div>
        </div>
    </form>
</div>

<script>
function EnableDisable() {
    //Reference the Button.
    var btnSubmit = document.getElementById("btnSubmit");

    //Verify the TextBox value.
    if (document.getElementById("search").value.length >= 3) {
        //Enable the TextBox when TextBox has value.
        btnSubmit.disabled = false;
    } else {
        //Disable the TextBox when TextBox is empty.
        btnSubmit.disabled = true;
    }
};
</script>
    