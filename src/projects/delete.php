<form
id="fm-delete-project-focus"
hx-get="<?php echo URL;?>src/projects/actions/delete_project.php"
hx-target="#dv-project-profile"
hx-swap="innerHTML"
hx-on::after-request="this.reset()"
class="d-grid"
>
<input type="hidden" name="id" value="<?php echo $project->id;?>"/>
<button type="submit" class="btn btn-outline-danger">Delete</button>

</form>