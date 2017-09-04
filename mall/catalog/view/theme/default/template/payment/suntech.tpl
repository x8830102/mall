<form class="form-horizontal" action="<?php echo $action; ?>" method="POST" id="payment">
    <?php if ($payment == 'suntech_buysafe' || (isset($cargo_option) && $cargo_option)) { ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h4>結帳選項</h4></div>
            <div class="panel-body">
                <?php if ($payment == 'suntech_buysafe') { ?>
                <div class="required">
                    <label class="control-label"><h4 style="display: inline;"><?php echo $installments_text; ?></h4></label>
                    <select class="form-control" id="installments" name="installments">
                        <option value=""><?php echo $installments_0; ?></option>
                        <?php if(count($installments) > 0) { ?>
                        <?php foreach($installments as $key => $installment) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $installment; ?></option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <?php } ?>
                <?php if (isset($cargo_option) && $cargo_option) { ?>
                <div class="required">
                  <label class="control-label">
                  <h4 style="display: inline;"><?php echo $cargo_text; ?></h4>
                  <input type="checkbox" value="ship" name="ship" id="ship" style="width: 20px;height: 20px;cursor: pointer;vertical-align: bottom;">
                  </label>
                </div>
                <?php // echo $cargo_notice; ?>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <fieldset>
        <div class="buttons">
            <div class="pull-right">
                <input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary"/>
            </div>
        </div>
    </fieldset>
</form>

