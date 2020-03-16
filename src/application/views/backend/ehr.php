<script src="<?= asset_url('assets/js/backend_services_helper.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_categories_helper.js') ?>"></script>
<script src="<?= asset_url('assets/js/backend_services.js') ?>"></script>
<script>
    var GlobalVariables = {
        csrfToken     : <?= json_encode($this->security->get_csrf_hash()) ?>,
        baseUrl       : <?= json_encode($base_url) ?>,
        ehrUrl        : <?= json_encode($ehr_url) ?>,
        dateFormat    : <?= json_encode($date_format) ?>,
        timeFormat    : <?= json_encode($time_format) ?>,
        services      : <?= json_encode($services) ?>,
        categories    : <?= json_encode($categories) ?>,
        meta          : <?= json_encode($meta) ?>,
        user          : {
            id        : <?= $user_id ?>,
            email     : <?= json_encode($user_email) ?>,
            role_slug : <?= json_encode($role_slug) ?>,
            privileges: <?= json_encode($privileges) ?>
        }
    };

    $(document).ready(function() {
        BackendServices.initialize(true);
    });
</script>

<div id="ehr-page" class="container-fluid backend-page">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#ehr" aria-controls="ehr" role="tab" data-toggle="tab"><?= lang('ehr') ?></a></li>
    </ul>

    <div class="tab-content">

        <!-- SERVICES TAB -->

        <div role="tabpanel" class="tab-pane active" id="ehr">
            <div class="row">
                <div id="filter-ehr" class="filter-records column col-xs-12 col-sm-5">
                    <div class="results">
                        <div class="ehr-row entry" data-id="1">
                            <strong>Key Info</strong>
                        </div>
                        <hr>
                        <div class="ehr-row entry" data-id="2">
                            <strong>ROS</strong>
                        </div>
                        <hr>
                        <div class="ehr-row entry" data-id="3">
                            <strong>Test</strong>
                        </div>
                        <hr>
                        <div class="ehr-row entry" data-id="4">
                            <strong>Exam</strong>
                        </div>
                        <hr>
                        <div class="ehr-row entry" data-id="4">
                            <strong>AP</strong>
                        </div>
                        <hr>
                        <div class="ehr-row entry" data-id="4">
                            <strong>Bills</strong>
                        </div>
                        <hr>
                    </div>
                </div>

                <div class="record-details column col-xs-12 col-sm-5">
                    <h3><?= lang('details') ?></h3>

                    <div class="form-message alert" style="display:none;"></div>

                    <input type="hidden" id="service-id">

                    <div class="form-group">
                        <label for="service-name"><?= lang('name') ?> *</label>
                        <input id="service-name" class="form-control required" maxlength="128">
                    </div>

                    <div class="form-group">
                        <label for="service-duration"><?= lang('duration_minutes') ?> *</label>
                        <input id="service-duration" class="form-control required" type="number" min="15">
                    </div>

                    <div class="form-group">
                        <label for="service-price"><?= lang('price') ?> *</label>
                        <input id="service-price" class="form-control required">
                    </div>

                    <div class="form-group">
                        <label for="service-currency"><?= lang('currency') ?></label>
                        <input id="service-currency" class="form-control" maxlength="32">
                    </div>

                    <div class="form-group">
                        <label for="service-category"><?= lang('category') ?></label>
                        <select id="service-category" class="form-control"></select>
                    </div>

                    <div class="form-group">
                        <label for="service-availabilities-type"><?= lang('availabilities_type') ?></label>
                        <select id="service-availabilities-type" class="form-control">
                            <option value="<?= AVAILABILITIES_TYPE_FLEXIBLE ?>">
                                <?= lang('flexible') ?>
                            </option>
                            <option value="<?= AVAILABILITIES_TYPE_FIXED ?>">
                                <?= lang('fixed') ?>
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="service-attendants-number"><?= lang('attendants_number') ?> *</label>
                        <input id="service-attendants-number" class="form-control required" type="number" min="1">
                    </div>

                    <div class="form-group">
                        <label for="service-description"><?= lang('description') ?></label>
                        <textarea id="service-description" rows="4" class="form-control"></textarea>
                    </div>

                    <p id="form-message" class="text-danger">
                        <em><?= lang('fields_are_required') ?></em>
                    </p>
                </div>
            </div>
        </div>

        <!-- CATEGORIES TAB -->

        <div role="tabpanel" class="tab-pane" id="categories">
            <div class="row">
                <div id="filter-categories" class="filter-records column col-xs-12 col-sm-5">
                    <form class="input-append">
                        <div class="input-group">
                            <input type="text" class="key form-control">

                            <span class="input-group-addon">
                        <div>
                            <button class="filter btn btn-default" type="submit" title="<?= lang('filter') ?>">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            <button class="clear btn btn-default" type="button" title="<?= lang('clear') ?>">
                                <span class="glyphicon glyphicon-repeat"></span>
                            </button>
                        </div>
                    </span>
                        </div>
                    </form>

                    <h3><?= lang('categories') ?></h3>
                    <div class="results"></div>
                </div>

                <div class="record-details col-xs-12 col-sm-5">
                    <div class="btn-toolbar">
                        <div class="add-edit-delete-group btn-group">
                            <button id="add-category" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus glyphicon glyphicon-white"></span>
                                <?= lang('add') ?>
                            </button>
                            <button id="edit-category" class="btn btn-default" disabled="disabled">
                                <span class="glyphicon glyphicon-pencil"></span>
                                <?= lang('edit') ?>
                            </button>
                            <button id="delete-category" class="btn btn-default" disabled="disabled">
                                <span class="glyphicon glyphicon-remove"></span>
                                <?= lang('delete') ?>
                            </button>
                        </div>

                        <div class="save-cancel-group btn-group" style="display:none;">
                            <button id="save-category" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok glyphicon glyphicon-white"></span>
                                <?= lang('save') ?>
                            </button>
                            <button id="cancel-category" class="btn btn-default">
                                <span class="glyphicon glyphicon-ban-circle"></span>
                                <?= lang('cancel') ?>
                            </button>
                        </div>
                    </div>

                    <h3><?= lang('details') ?></h3>

                    <div class="form-message alert" style="display:none;"></div>

                    <input type="hidden" id="category-id">

                    <div class="form-group">
                        <label for="category-name"><?= lang('name') ?> *</label>
                        <input id="category-name" class="form-control required">
                    </div>

                    <div class="form-group">
                        <label for="category-description"><?= lang('description') ?></label>
                        <textarea id="category-description" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- RECORDS TAB -->

        <div role="tabpanel" class="tab-pane" id="records">
            <div class="row">
                <div id="filter-records" class="filter-records column col-xs-12 col-sm-5">
                    <form class="input-append">
                        <div class="input-group">
                            <input type="text" class="key form-control">

                            <span class="input-group-addon">
                        <div>
                            <button class="filter btn btn-default" type="submit" title="<?= lang('filter') ?>">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                            <button class="clear btn btn-default" type="button" title="<?= lang('clear') ?>">
                                <span class="glyphicon glyphicon-repeat"></span>
                            </button>
                        </div>
                    </span>
                        </div>
                    </form>

                    <h3><?= lang('records') ?></h3>
                    <div class="results"></div>
                </div>

                <div class="service-record-detail col-xs-12 col-sm-9">
                    <div class="btn-toolbar">
                        <div class="add-edit-delete-group btn-group hide">
                            <button id="add-category" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus glyphicon glyphicon-white"></span>
                                <?= lang('add') ?>
                            </button>
                            <button id="edit-category" class="btn btn-default" disabled="disabled">
                                <span class="glyphicon glyphicon-pencil"></span>
                                <?= lang('edit') ?>
                            </button>
                            <button id="delete-category" class="btn btn-default" disabled="disabled">
                                <span class="glyphicon glyphicon-remove"></span>
                                <?= lang('delete') ?>
                            </button>
                        </div>

                        <div class="save-cancel-group btn-group" style="display:none;">
                            <button id="save-category" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok glyphicon glyphicon-white"></span>
                                <?= lang('save') ?>
                            </button>
                            <button id="cancel-category" class="btn btn-default">
                                <span class="glyphicon glyphicon-ban-circle"></span>
                                <?= lang('cancel') ?>
                            </button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="column col-sm-12 text-center overview">
                            <div class="column col-sm-3">
                                NAME:
                                <span>John Doe</span>
                            </div>
                            <div class="column col-sm-3">
                                AGE:
                                <span>31</span>
                            </div>
                            <div class="column col-sm-3">
                                GENDER:
                                <span>Male</span>
                            </div>
                            <div class="column col-sm-3">
                                DOB:
                                <span>01/28/1982</span>
                            </div>
                        </div>
                        <div class="column col-sm-2">
                            <ul class="nav nav-tabs flex-column">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#keyinfo" data-toggle="tab">Key Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#ros" data-toggle="tab">ROS</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#test" data-toggle="tab">Test</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#exam" data-toggle="tab">Exam</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#ap" data-toggle="tab">AP</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#bills" data-toggle="tab">Bills</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content column col  -sm-6">
                            <div role="tabpanel" class="tab-pane active" id="keyinfo">
                                <div class="form-message alert" style="display:none;"></div>
                                <div class="form-group">
                                    <label for="category-name"><?= lang('name') ?> *</label>
                                    <input id="category-name" class="form-control required">
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="ros">
                                <div class="form-message alert" style="display:none;"></div>
                                <div class="form-group">
                                    <label for="category-name"><?= lang('name') ?> *</label>
                                    <input id="category-name" class="form-control required">
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="test">
                                <div class="form-message alert" style="display:none;"></div>
                                <div class="form-group">
                                    <label for="category-name"><?= lang('name') ?> *</label>
                                    <input id="category-name" class="form-control required">
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="exam">
                                <div class="form-message alert" style="display:none;"></div>
                                <div class="form-group">
                                    <label for="category-name"><?= lang('name') ?> *</label>
                                    <input id="category-name" class="form-control required">
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="ap">
                                <div class="form-message alert" style="display:none;"></div>
                                <div class="form-group">
                                    <label for="category-name"><?= lang('name') ?> *</label>
                                    <input id="category-name" class="form-control required">
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="bills">
                                <div class="form-message alert" style="display:none;"></div>
                                <div class="form-group">
                                    <label for="category-name"><?= lang('name') ?> *</label>
                                    <input id="category-name" class="form-control required">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
</script>