<section class="container row justify-content-center">

    <div class="col-sm-12 col-md-10">
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

    <div class="row g-3 align-items-start">

        <div class="col-sm-12 col-md-8">

            <input type="text" name="title" id="txttitle" placeholder="Project Title" class="form-control" required/>

        </div>

        <div class="col-sm-12 col-md-4">

            <button type="submit" class="btn btn-primary">Add Project</button>

        </div>

    </div>


</form>

</div>

</section>

