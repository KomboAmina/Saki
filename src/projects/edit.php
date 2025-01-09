<form
id="fm-edit-project-focus"
hx-get="<?php echo URL;?>src/projects/actions/edit_project.php"
hx-target="#dv-project-profile"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="d-grid mb-2"
>
<input type="hidden" name="id" value="<?php echo $project->id;?>"/>
<button type="submit" class="btn btn-primary skew-10">Edit</button>

</form>