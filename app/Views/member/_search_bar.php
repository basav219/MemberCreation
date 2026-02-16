<div class="card mb-3 shadow-sm member-search-card">
    <div class="card-body">

        <div class="row align-items-center">

            <!-- 🔍 SEARCH BOX (LEFT)
            <div class="col-md-9">
                <form method="get" action="<?= site_url('member/list') ?>">
                    <div class="input-group search-input-group">
                        <input type="text"
                               name="q"
                               class="form-control search-input"
                               placeholder="Search by Name, Mobile, Member ID, Customer ID"
                               value="<?= esc($search ?? '') ?>">

                        <button type="submit" class="btn btn-dark search-btn px-4">
                            🔍 Search
                        </button>
                    </div> -->
                <!-- </form>
            </div> -->

            <!-- ➕ ADD NEW MEMBER (RIGHT SIDE) -->
            <div class="col-md-3">
                <a href="<?= site_url('member/create') ?>"
                   class="btn btn-primary add-member-btn px-4">
                    ➕ Add New Member
                </a>
            </div>

        </div>

    </div>
</div>