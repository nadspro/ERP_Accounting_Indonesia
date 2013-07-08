<div class="row">
    <div class="span2">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo $model->companyfirst->start_date ?></h3>
                    <h6 align="center" ><font COLOR="#999">Join Date</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="span2">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo (isset($model->leaveBalance)) ? $model->leaveBalance->mass_leave : 0 ?></h3>
                    <h6 align="center" ><font COLOR="#999">Mass Leave</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="span2">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo (isset($model->leaveBalance)) ? $model->leaveBalance->person_leave : 0 ?></h3>
                    <h6 align="center" ><font COLOR="#999">Private Leave</font></h6></td>
            </tr>
        </table>
    </div>

    <div class="span2">
        <table width="100%">
            <tr bgcolor="EAEFFF">
                <td  align="center"><h3><?php echo (isset($model->leaveBalance)) ? $model->leaveBalance->balance : 0 ?></h3>
                    <h6 align="center" ><font COLOR="#999">Balance</font></h6></td>
            </tr>
        </table>
    </div>

    <?php /*
      <div class="span2">
      <table width="100%">
      <tr bgcolor="EAEFFF">
      <td  align="center"><h3>.</h3>
      <h6 align="center" ><font COLOR="#999">Reserved</font></h6></td>
      </tr>
      </table>
      </div>
     */ ?>

</div>

<br/>
