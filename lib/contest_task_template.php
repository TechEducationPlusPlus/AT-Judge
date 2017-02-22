<form enctype="multipart/form-data" action="/submission.php" method="POST" onsubmit="return validateForm()">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" minlength=1 required name="email" value="{{email}}" readonly="" class="form-control"><small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small></div>
    <fieldset>
        <legend>Submit:</legend>
        <div class="form-group">
            <label for="sourcecode">your source code</label>
            <div style="border: 2pt solid #777;">
                <textarea id="sourcecode" name="sourcecode" rows="20" autocorrect="off" autocapitalize="off" spellcheck="false" tabindex="0" wrap="on" class="form-control" style="border: 1px solid black;"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label" for="uploadedfile">Source code file</label>
            <input id="uploadedfile" type="file">
            <input readonly="" class="form-control" placeholder="Browse..." type="text">
        </div>
    </fieldset>
    <div class="form-group">
        <label for="lang">Language</label>
        <select id="lang" name="lang" class="form-control" onchange="change();"></select>
    </div>
    <input type="hidden" name="contest" value="{{contestid}}">
	<input name="task" type="hidden" value="{{taskid}}">
    <button type="submit" class="btn btn-raised btn-success">Submit</button>
</form>
<div id="test" style="display:none;"> </div>

<script>
    function validateForm() {
        var x = document.forms[0]["email"].value;
        if (x == "") {
            alert("Please, login!");
            return false;
        }
    }
    var editor;
    var modes = {
        js: "javascript",
        java: "text/x-java",
        c: "text/x-csrc",
        cpp: "text/x-c++src",
        cs: "text/x-csharp",
        php: "application/x-httpsd-php",
        py: "text/x-python",
        cy: "text/x-cython",
        hs: "text/x-haskell",
        ts: "application/typescript"
    };
    var names = {{langs}};

    function change() {
        var e = document.getElementById("lang");
        var value = e.options[e.selectedIndex].value;
        var text = e.options[e.selectedIndex].text;
        document.getElementById("test").innerHTML += "change (): value = " + value + ", text = " + text + ", mode [value]: " + modes[value] + "<br>";
        editor.setOption("mode", modes[value]);
        CodeMirror.autoLoadMode(editor, modes[value]);
    }

    window.onload = function() {
        for (var mode in names) {
            document.getElementById("test").innerHTML += mode + " -> " + modes[mode] + "<br>";
            document.getElementById("lang").innerHTML += "<option value='" + mode + "'>" + names[mode] + "</option>";
        }
        CodeMirror.modeURL = "https://codemirror.net/mode/%N/%N.js";
        editor = CodeMirror.fromTextArea(document.getElementById("sourcecode"), {
            mode: "text/x-c++src",
            theme: "default",
            lineNumbers: true,
            lineWrapping: true
        });
    };
</script>
