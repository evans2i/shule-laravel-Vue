  <div class="hello">
    <!-- $FORMNAME$ -->
    <form @submit.prevent="editmode ? update$FORMNAME$() : create$FORMNAME$()">
      <div class="modal-body">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button :disabled="isDisabled" type="submit" class="btn btn-primary">Save changes</button>
        <!-- :disabled='isDisabled' -->
      </div>
    </form>
    <!-- end of the $FORMNAME$ -->
  </div>