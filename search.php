<?php
if (isset( $_GET[ 'pattern' ] ) && !empty( $_GET[ 'pattern' ] )) {
    include_once( 'views/partials/header.php' );
    include_once( 'system/search-engine.php' );

    $results = SearchEngine::searchFor( $_GET[ 'pattern' ] );
} else {
    header( 'Location: index.php' );
}
?>
<main class="container">
    <?php if (!empty( $results[ 'users' ] )): ?>
    <section class="row">
        <div class="col-md-12">
            <div class="jumbotron">
                <header>
                    <h2>User matches:</h2>
                </header>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($results[ 'users' ] as $user): ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td>
                            <a href="./profile.php?id=<?=$user->getId()?>">
                                <?= htmlspecialchars( $user->getUserName() ) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars( $user->getEmail() ) ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php if (!empty( $results[ 'albums' ] )): ?>
        <section class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                    <header>
                        <h2>Album matches:</h2>
                    </header>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date created</th>
                            <th>Total pictures</th>
                            <th>Rating</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($results[ 'albums' ] as $album): ?>
                            <tr>
                                <td><?= $album->getId() ?></td>
                                <td>
                                    <a href="./albums.php?id=<?=$album->getId()?>">
                                        <?= htmlspecialchars( $album->getName() )?>
                                    </a>
                                </td>
                                <td><?= $album->getDateCreated() ?></td>
                                <td><?= $album->getPicturesCount() ?></td>
                                <td><?= $album->getRatingNumber() ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if (!empty( $results[ 'pics' ] )): ?>
        <section class="jumbotron">
            <div class="row">
                <div class="col-md-12">
                    <header>
                        <h2>Pics matches:</h2>
                    </header>
                </div>
                <?php foreach ($results[ 'pics' ] as $pic): ?>
                <div class="col-md-4">
                    <figure>
                        <a href="./albums.php?id=<?=$pic -> getId()?>">
                            <img class="img-responsive" src=<?= $pic->getFullPath() ?>>
                        </a>
                        <figcaption class="text-center"><?= htmlentities($pic->getName()) ?></figcaption>
                    </figure>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</main>
<?php include_once( 'views/partials/footer.php' );