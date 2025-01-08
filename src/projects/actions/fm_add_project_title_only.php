<section class="container">

<form
id="fm-add-project"
hx-post="<?php echo URL;?>src/projects/actions/index.php"
hx-target="#dv-list"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="bordered"
>

    <input type="hidden" name="action" value="add project"/>

    <input type="hidden" name="desc" value="project description here."/>

    <div class="row">

        <div class="col-sm-12 col-md-8">

            <input type="text" name="title" id="txttitle" placeholder="Project Title" class="form-control" required/>

        </div>

        <div class="col-sm-12 col-md-4">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Add Project</button>
            </div>
        </div>

    </div>


</form>

</section>