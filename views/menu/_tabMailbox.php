<div style="border-bottom:solid;border-width:1px;border-color:#D5D5D5;padding:0;margin:10px 0;">
    <ul class="nav nav-list">
        <li class="nav-header"><i class="icon-fa-envelope"></i><?php echo Yii::t('basic', ' Personal Mailbox') ?></span>
        </li>
    </ul>
</div>

<div class="well">
    <?php
    if (isset($_GET['Message_sort']))
        $sortby = $_GET['Message_sort'];
    elseif (isset($_GET['Mailbox_sort']))
        $sortby = $_GET['Mailbox_sort'];
    else
        $sortby = '';

    //$this->renderpartial('_flash');

    if ($dataProvider->getItemCount() > 0) {

        $this->widget('zii.widgets.CListView', array(
            'id' => 'mailbox',
            'dataProvider' => $dataProvider,
            'itemView' => '_mailList',
            'itemsTagName' => 'table',
            'template' => '{items}{pager}',
            'sortableAttributes' => $this->getAction()->getId() == 'sent' ?
                    array('created' => 'Date Sent') :
                    array('modified' => 'Date Received'),
            'loadingCssClass' => 'mailbox-loading',
            'ajaxUpdate' => 'mailbox-list',
            'afterAjaxUpdate' => '$.yiimailbox.updateMailbox',
            'emptyText' => '<div style="width:100%"><h3>You have no mail in your ' . $this->getAction()->getId() . ' folder.</h3></div>',
            //'htmlOptions'=>array(),
            'sorterHeader' => '',
                //'sorterCssClass'=>'mailbox-sorter',
                //'itemsCssClass'=>'mailbox-items-tbl',
                //'pagerCssClass'=>'mailbox-pager',
                //'updateSelector'=>'.inbox',
        ));
    }
    else
        $this->renderpartial('_mailEmpty');
    ?>
</div>


<script type="text/javascript">
    /*<![CDATA[*/
    jQuery(function($) {
        $('.message-subject').hide();
    });
    /*]]>*/
</script>
