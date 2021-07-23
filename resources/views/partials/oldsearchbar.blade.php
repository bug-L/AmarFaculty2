
<div class="row searchbar">
    <div class="valign-wrapper hide-on-small-only">
        <div class="col m9 l9">
            <nav class="light-blue lighten-3">
                <div class="nav-wrapper">
                    <form action="/professors/search" method="POST" role="search">
                    {{ csrf_field() }}
                        <div class="input-field">
                            <input id="search" name="q" value="{{ old('q') }}" type="search" placeholder="Faculty name/initials" minlength="3" maxlength="30" required>
                            <label class="label-icon" for="search"><i class="material-icons">forward</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
        <div class="col m3 l2">
            <button type="submit" class="waves-effect waves-light btn-large"><i class="material-icons">search</i></button>
        </div>
    </div>
    <div class="hide-on-med-and-up center-align">
        <div class="col s12">
            <nav class="lime lighten-2">
                <div class="nav-wrapper">
                    <form action="/professors/search" method="POST" role="search">
                    {{ csrf_field() }}
                        <div class="input-field">
                            <input id="search" name="q" value="{{ old('q') }}" type="search" placeholder="Faculty Name/Initials" minlength="3" maxlength="30" required>
                            <label class="label-icon" for="search"><i class="material-icons">forward</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    
                </div>
            </nav>
        </div>
        <div class="col s12 searchbar-button-small">
            <button type="submit" class="waves-effect waves-light btn blue darken-2">Find Faculty<i class="material-icons right">search</i></button>
        </div></form>
    </div>
</div>