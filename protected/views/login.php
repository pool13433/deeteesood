<div class="ui centered grid stackable" style="margin: 0rem;">
    <div class="ui four wide column">
        <h5 class="ui top attached header left aligned">
            เข้าระบบ
        </h5>
        <div class="ui attached segment">
            <form class="ui form" method="post" action="<?= Yii::app()->createUrl('/site/login') ?>">
                <?php foreach (Yii::app()->user->getFlashes() as $key => $message) { ?>
                    <div class="ui negative message">
                        <i class="close icon"></i>
                        <div class="ui header left aligned">
                            <?= $message ?> 
                        </div>
                    </div>
                <?php } ?>

                <div class="inline fields">
                    <div class="six wide field">
                        <label>Username</label>
                    </div>
                    <div class="ten wide field">
                        <input name="username" placeholder="Username" type="text">
                    </div>
                </div>
                <div class="inline fields">
                    <div class="six wide field">
                        <label>Password</label>
                    </div>
                    <div class="ten wide field">
                        <input name="password" placeholder="Password" type="password">
                    </div>
                </div>
                <div class="ui actions">
                    <button class="ui button green fluid">เข้าระบบ</button>
                </div>
            </form>
        </div>
    </div>
</div>