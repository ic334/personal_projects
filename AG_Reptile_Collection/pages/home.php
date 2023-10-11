<?php
include('includes/init.php');
$title = 'Avant Garde Reptile Collection';

// Set maximum file size for file uploads
// MAX_FILE_SIZE must be set to bytes
// 1 MB = 1000000 bytes
define('MAX_FILE_SIZE', 1000000);

// Only an 'admin' user may edit tags and reptiles
if ($is_admin) {

  // --- Add Reptile ---

  // feedback message CSS classes
  $name_feedback_class = 'hidden';
  $species_feedback_class = 'hidden';
  $family_feedback_class = 'hidden';
  $type_feedback_class = 'hidden';
  $price_feedback_class = 'hidden';
  $file_name_feedback_class = 'hidden';
  $file_ext_feedback_class = 'hidden';
  $source_feedback_class = 'hidden';

  // additional validation constraints
  $reptile_inserted = False;
  $reptile_insert_failed = False;

  // insert values
  $name = NULL;
  $species = NULL;
  $family = NULL;
  $type = NULL;
  $price = NULL;
  $file_name = NULL;
  $file_ext = NULL;
  $source = NULL;

  // sticky values
  $sticky_name = '';
  $sticky_species = '';
  $sticky_family = '';
  $sticky_type = '';
  $sticky_price = '';
  $sticky_file_name = '';
  $sticky_file_ext = '';
  $sticky_source = '';

  // insert reptile submitted
  if (isset($_POST['add_reptile_submit'])) {
    $name = trim($_POST['name']); // untrusted
    $species = trim($_POST['species']); // untrusted
    $family = trim($_POST['family']); // untrusted
    $type = trim($_POST['type']); // untrusted
    $price = trim($_POST['price']); // untrusted
    $file_name = trim($_POST['file_name']); // untrusted
    $file_ext = strtolower(trim($_POST['file_ext'])); // untrusted
    $source = trim($_POST['source']); // untrusted

    $form_valid = True;

    // Begin transaction
    $db->beginTransaction();

    // name is required
    if (empty($name)) {
      $form_valid = False;
      $name_feedback_class = '';
    }

    // species is required
    if (empty($species)) {
      $form_valid = False;
      $species_feedback_class = '';
    }

    // family is required
    if (empty($family)) {
      $form_valid = False;
      $family_feedback_class = '';
    }

    // type is required
    if (empty($type)) {
      $form_valid = False;
      $type_feedback_class = '';
    }

    // price is required
    if (empty($price)) {
      $form_valid = False;
      $price_feedback_class = '';
    }

    // file_name is required
    if (empty($file_name)) {
      $form_valid = False;
      $file_name_feedback_class = '';
    }

    // file_ext is required
    if (empty($file_ext)) {
      $form_valid = False;
      $file_ext_feedback_class = '';
    }

    // source is required
    if (empty($source)) {
      $form_valid = False;
      $source_feedback_class = '';
    }

    if ($form_valid) {
      // insert new record into database
      $result = exec_sql_query(
        $db,
        'INSERT INTO reptiles (name, species, family, type, price, file_name, file_ext, source)
      VALUES (:name, :species, :family, :type, :price, :file_name, :file_ext, :source);',
        array(
          ':name' => $name, // tainted
          ':species' => $species, // tainted
          ':family' => $family, // tainted
          ':type' => $type, // tainted
          ':price' => $price, // tainted
          ':file_name' => $file_name, // tainted
          ':file_ext' => $file_ext, // tainted
          ':source' => $source // tainted

        )
      );

      // End transaction
      $db->commit();

      // did the insert into the database succeed?
      if ($result) {

        $reptile_inserted = True;
      } else {

        // This line of code will probably never be executed
        $reptile_insert_failed = True;
      }
    } else {
      // set sticky values
      $sticky_name = $name;
      $sticky_species = $species;
      $sticky_family = $family;
      $sticky_type = $type;
      $sticky_price = $price;
      $sticky_file_name = $file_name;
      $sticky_file_ext = $file_ext;
      $sticky_source = $source;
    }
  }

  // --- Remove Reptile ---

  // feedback message CSS classes
  $remove_reptile_feedback_class = 'hidden';

  // additional validation constraints
  $reptile_removed = False;
  $reptile_remove_failed = False;

  // insert values
  $reptile_id = NULL;

  // sticky values
  $sticky_reptile_id = '';

  // remove reptile submitted
  if (isset($_POST['remove_reptile_submit'])) {
    $reptile_id = trim($_POST['remove_reptile_select']); // untrusted

    $form_valid = True;

    // Begin transaction
    $db->beginTransaction();

    // reptile_id is required
    if (empty($reptile_id)) {
      $form_valid = False;
      $remove_reptile_feedback_class = '';
    }

    if ($form_valid) {
      // remove record from database
      $result = exec_sql_query(
        $db,
        'DELETE FROM reptiles WHERE (id=:reptile_id);',
        array(
          ':reptile_id' => $reptile_id, // tainted
        )
      );
      exec_sql_query(
        $db,
        'DELETE FROM reptile_tags WHERE (reptile_id=:reptile_id);',
        array(
          ':reptile_id' => $reptile_id, // tainted
        )
      );

      // End transaction
      $db->commit();

      // did the removal from the database succeed?
      if ($result) {

        $reptile_removed = True;
      } else {

        // This line of code will probably never be executed
        $reptile_remove_failed = True;
      }
    } else {
      // set sticky values
      $sticky_reptile_id = $reptile_id;
    }
  }

  // --- Create Tag ---

  // feedback message CSS classes
  $tag_name_feedback_class = 'hidden';

  // additional validation constraints
  $tag_inserted = False;
  $tag_insert_failed = False;

  // insert values
  $tag_name = NULL;

  // sticky values
  $sticky_tag_name = '';

  // insert reptile submitted
  if (isset($_POST['create_tag_submit'])) {
    $tag_name = strtolower(trim($_POST['tag_name'])); // untrusted

    $form_valid = True;

    // Begin transaction
    $db->beginTransaction();

    // tag_name is required
    if (empty($tag_name)) {
      $form_valid = False;
      $tag_name_feedback_class = '';
    }

    if ($form_valid) {
      // insert new record into database
      $result = exec_sql_query(
        $db,
        'INSERT INTO tags (tag_name) VALUES (:tag_name);',
        array(
          ':tag_name' => $tag_name // tainted
        )
      );

      // End transaction
      $db->commit();

      // did the insert into the database succeed?
      if ($result) {

        $tag_inserted = True;
      } else {

        // This line of code will probably never be executed
        $tag_insert_failed = True;
      }
    } else {
      // set sticky values
      $sticky_tag_name = $tag_name;
    }
  }

  // --- Add Tag ---

  // feedback message CSS classes
  $add_tag_feedback_class = 'hidden';
  $add_tag_reptile_feedback_class = 'hidden';

  // additional validation constraints
  $added_tag = False;
  $add_tag_failed = False;

  // insert values
  $tag_id = NULL;
  $reptile_id = NULL;

  // sticky values
  $sticky_tag_id_add = '';
  $sticky_reptile_id_add = '';

  // add tag submitted
  if (isset($_POST['add_tag_submit'])) {
    $tag_id = strtolower(trim($_POST['add_tag_select'])); // untrusted
    $reptile_id = strtolower(trim($_POST['add_tag_reptile_select'])); // untrusted

    $form_valid = True;

    // Begin transaction
    $db->beginTransaction();

    // tag_name is required
    if (empty($tag_id)) {
      $form_valid = False;
      $add_tag_feedback_class = '';
    }

    if (empty($reptile_id)) {
      $form_valid = False;
      $add_tag_reptile_feedback_class = '';
    }

    if ($form_valid) {
      // insert new record into database
      $result = exec_sql_query(
        $db,
        'INSERT INTO reptile_tags (reptile_id, tag_id) VALUES (:reptile_id, :tag_id);',
        array(
          ':reptile_id' => $reptile_id, // tainted
          ':tag_id' => $tag_id // tainted
        )
      );

      // End transaction
      $db->commit();

      // did the insert into the database succeed?
      if ($result) {

        $added_tag = True;
      } else {

        // This line of code will probably never be executed
        $add_tag_failed = True;
      }
    } else {
      // set sticky values
      $sticky_tag_id_add = $tag_id;
      $sticky_reptile_id_add = $reptile_id;
    }
  }


  // --- Remove Tag ---

  // feedback message CSS classes
  $remove_tag_feedback_class = 'hidden';
  $remove_tag_reptile_feedback_class = 'hidden';

  // additional validation constraints
  $removed_tag = False;
  $remove_tag_failed = False;

  // insert values
  $tag_id = NULL;
  $reptile_id = NULL;

  // sticky values
  $sticky_tag_id_remove = '';
  $sticky_reptile_id_remove = '';

  // remove tag submitted
  if (isset($_POST['remove_tag_submit'])) {
    $tag_id = strtolower(trim($_POST['remove_tag_select'])); // untrusted
    $reptile_id = strtolower(trim($_POST['remove_tag_reptile_select'])); // untrusted

    $form_valid = True;

    // Begin transaction
    $db->beginTransaction();

    // tag_name is required
    if (empty($tag_id)) {
      $form_valid = False;
      $remove_tag_feedback_class = '';
    }

    if (empty($reptile_id)) {
      $form_valid = False;
      $remove_tag_reptile_feedback_class = '';
    }

    if ($form_valid) {
      // insert new record into database
      $result = exec_sql_query(
        $db,
        'DELETE FROM reptile_tags WHERE (reptile_id=:reptile_id AND tag_id=:tag_id);',
        array(
          ':reptile_id' => $reptile_id, // tainted
          ':tag_id' => $tag_id // tainted
        )
      );

      // End transaction
      $db->commit();

      // did the removal from the database succeed?
      if ($result) {

        $removed_tag = True;
      } else {

        // This line of code will probably never be executed
        $remove_tag_failed = True;
      }
    } else {
      // set sticky values
      $sticky_tag_id_remove = $tag_id;
      $sticky_reptile_id_remove = $reptile_id;
    }
  }
}

// query the database for reptile records
$records = exec_sql_query(
  $db,
  'SELECT * FROM reptiles;'
)->fetchAll();

$tag_selected = (int)trim($_GET['tag']); // untrusted'
$reptile_selected = (int)trim($_GET['reptile']); // untrusted

if ($tag_selected) {
  $records = exec_sql_query(
    $db,
    'SELECT * FROM reptiles WHERE reptiles.id IN (SELECT reptile_tags.reptile_id FROM reptile_tags LEFT OUTER JOIN tags ON tags.id = reptile_tags.tag_id WHERE (tags.id = :tag_selected));',
    array(
      ':tag_selected' => $tag_selected
    )
  )->fetchAll();
}

if ($reptile_selected) {
  $records = exec_sql_query(
    $db,
    'SELECT * FROM reptiles WHERE (id = :reptile_selected);',
    array(
      ':reptile_selected' => $reptile_selected
    )
  )->fetchAll();
}

$reptile_tags = exec_sql_query(
  $db,
  'SELECT reptile_tags.reptile_id, reptile_tags.tag_id, tags.tag_name FROM reptile_tags INNER JOIN tags ON reptile_tags.tag_id = tags.id;'
)->fetchAll();

$tags = exec_sql_query(
  $db,
  'SELECT * FROM tags ORDER BY tag_name ASC;'
)->fetchAll();

$show_entire_collection_class = 'hidden';
$currently_displaying = 'Entire Collection';

if ($tag_selected) {
  $show_entire_collection_class = '';
  $curr_display = exec_sql_query(
    $db,
    'SELECT * FROM tags WHERE (id=:tag_selected);',
    array(
      ':tag_selected' => $tag_selected
    )
  )->fetchAll();

  foreach ($curr_display as $curr_dis) {
    $currently_displaying = ucfirst($curr_dis['tag_name']);
  }
}

if ($reptile_selected) {

  $show_entire_collection_class = '';

  $curr_display = exec_sql_query(
    $db,
    'SELECT * FROM reptiles WHERE (id=:reptile_selected);',
    array(
      ':reptile_selected' => $reptile_selected
    )
  )->fetchAll();

  foreach ($curr_display as $curr_dis) {
    $currently_displaying = ucfirst($curr_dis['species']) . ' (id=' . $curr_dis['id'] . ')';
  }
}

$url = '/home?';
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>

  <?php include('includes/header.php'); ?>

  <main>

    <?php
    if (!is_user_logged_in()) { ?>
      <h2 class='margin-top'>Login</h2>
    <?php echo_login_form('/home', $session_messages);
    } else { ?>
      <p><a id='logout' href='<?php echo logout_url(); ?>'>Sign Out</a></p>

      <div class='hor-flex align-center'>

        <div class='vert-flex welcome'>

          <h2> Welcome </h2>
          <p>Welcome to the Avant Garde Reptile Collection where we strive to create new, creative and experimental patterns through breeding and raising some of the healthiest reptiles on the market.</p>

          <h2>About the Owner: Rodrigo Cervantes</h2>
          <p>Avant Garde Reptile Collection (AGRC) was established in 2021 and inspired by some of the biggest names in the reptile industry. As a kid I spend hours watching Brian Barczyk, Justin Kobylka, Garrick DeMyer and many more on YouTube just trying to learn as much as I could about reptiles. I quickly realized I had a passion for reptiles and wanted to start a collection. Today AGRC consist of primarily ball pythons with some colubrids (Western hognose and African house snakes) and lizards (Bearded dragons and crested geckos). Our mission is to impress everyone in the Reptile community but producing jaw dropping animals for everyone to enjoy!</p>
          <p>“Just a couple of folks who love reptiles and want to share out growing collection with the world” -AGRC </p>

        </div>
        <figure>

          <div class='vert-flex'>

            <!-- Source: https://www.instagram.com/agreptilecollection/ -->
            <img src="/public/images/ag-logo3.jpeg" alt="Avant Garde Logo" />
            Source: <cite><a href="https://www.instagram.com/agreptilecollection/">Avant Garde Reptile Collection Instagram</a></cite>

          </div>

        </figure>

      </div>

      <h2>Reptile Collection</h2>

      <?php if ($reptile_inserted) { ?>
        <p>
          <em><?php echo htmlspecialchars($name) . ' the ' . htmlspecialchars($species); ?>, was successfully added to the collection!</em>
        </p>
      <?php } ?>

      <?php if ($reptile_insert_failed) { ?>
        <p>
          <em>Failed to add new reptile to the collection!</em>
        </p>
      <?php } ?>

      <?php if ($reptile_removed) { ?>
        <p>
          <em>Reptile was successfully removed from collection!</em>
        </p>
      <?php } ?>

      <?php if ($reptile_remove_failed) { ?>
        <p>
          <em>Failed to remove reptile from collection!</em>
        </p>
      <?php } ?>

      <?php if ($tag_inserted) { ?>
        <p>
          <em>'<?php echo htmlspecialchars($tag_name) ?>', was successfully added to the list of tags!</em>
        </p>
      <?php } ?>

      <?php if ($tag_insert_failed) { ?>
        <p>
          <em>Failed to add new tag!</em>
        </p>
      <?php } ?>

      <?php if ($added_tag) { ?>
        <p>
          <em> Tag was successfully added to reptile!</em>
        </p>
      <?php } ?>

      <?php if ($add_tag_failed) { ?>
        <p>
          <em>Failed to add tag to reptile!</em>
        </p>
      <?php } ?>

      <?php if ($removed_tag) { ?>
        <p>
          <em>Tag was successfully removed from reptile!</em>
        </p>
      <?php } ?>

      <?php if ($tag_remove_failed) { ?>
        <p>
          <em>Failed to remove tag from reptile!</em>
        </p>
      <?php } ?>


      <h4>Currently Displaying: <?php echo htmlspecialchars($currently_displaying) ?></h4>

      <form id='show_entire_collection_form' method='post' action='/<?php htmlspecialchars($url) . '&' . htmlspecialchars(http_build_query(array('reptile' => NULL))) . '&' . htmlspecialchars(http_build_query(array('tag' => NULL))); ?>' novalidate>
        <input class='<?php echo htmlspecialchars($show_entire_collection_class) ?>' id='show_entire_collection_button' name='show_entire_collection_button' type='submit' value='Show Entire Collection' />
      </form>

      <section class='grid'>
        <h6 class='hidden'>Need this heading to prevent errors in html validator</h6>
        <?php
        // Only show grid if we have records to display
        if (count($records) > 0) { ?>
          <ul>
            <?php foreach ($records as $record) { ?>
              <li>
                <a href='<?php echo htmlspecialchars($url) . '&' . htmlspecialchars(http_build_query(array('reptile' => $record['id']))); ?>'>
                  <img src='public/uploads/documents/<?php echo $record['id'] . '.' . $record['file_ext']; ?>' alt='<?php echo htmlspecialchars($record['species']); ?>' />
                </a>
                <section>
                  <h6 class='hidden'>Need this heading to prevent errors in html validator</h6>
                  <!-- Source: https://www.instagram.com/agreptilecollection/ -->
                  Source: <cite><a href="https://www.instagram.com/agreptilecollection/">Avant Garde Reptile Collection Instagram</a></cite>
                </section>
                <p><strong>Name: </strong>
                  <?php
                  if ($record['name'] == NULL) {
                    echo '-';
                  } else {
                    echo ucfirst($record['name']);
                  }
                  ?>
                </p>
                <p><strong>Species: </strong><?php echo ucfirst($record['species']); ?></p>
                <p><strong>Family: </strong><?php echo ucfirst($record['family']); ?></p>
                <p><strong>Type: </strong><?php echo ucfirst($record['type']); ?></p>
                <p><strong>Price: </strong>$<?php echo ucfirst($record['price']); ?></p>
                <p><strong>Tags:</strong>
                  <?php
                  foreach ($reptile_tags as $reptile_tag) {
                    if ($record['id'] == $reptile_tag['reptile_id']) { ?>
                      <a class='spaced' href='<?php echo htmlspecialchars($url) . '&' . htmlspecialchars(http_build_query(array('tag' => $reptile_tag['tag_id']))); ?>'><?php echo ucfirst(htmlspecialchars($reptile_tag['tag_name'])); ?></a>
                  <?php }
                  }
                  ?>
                </p>

              </li>
            <?php } ?>
          </ul>
        <?php } else { ?>
          <p>No reptile records found.</p>
        <?php } ?>
      </section>
    <?php } ?>

    <?php if ($is_admin) { ?>
      <h2>Add Reptile to Collection</h2>

      <form id='add_reptile_form' method='post' action='/' novalidate>

        <!-- name -->
        <p id='name_feedback' class='feedback-message <?php echo $name_feedback_class; ?>'>Please provide a valid name.</p>
        <div class='group-label-input'>
          <label for='add_name'>Name:</label>
          <input id='add_name' type='text' name='name' value='<?php echo htmlspecialchars($sticky_name); ?>' required>
        </div>

        <!-- species -->
        <p id='species_feedback' class='feedback-message <?php echo $species_feedback_class; ?>'>Please provide a valid species.</p>
        <div class='group-label-input'>
          <label for='add_species'>Species:</label>
          <input id='add_species' type='text' name='species' value='<?php echo htmlspecialchars($sticky_species); ?>' required>
        </div>

        <!-- family -->
        <p id='family_feedback' class='feedback-message <?php echo $family_feedback_class; ?>'>Please provide a valid reptile family.</p>
        <div class='group-label-input'>
          <label for='add_family'>Family:</label>
          <input id='add_family' type='text' name='family' value='<?php echo htmlspecialchars($sticky_family); ?>' required>
        </div>

        <!-- type -->
        <p id='type_feedback' class='feedback-message <?php echo $type_feedback_class; ?>'>Please provide a valid reptile type.</p>
        <div class='group-label-input'>
          <label for='add_type'>Type:</label>
          <input id='add_type' type='text' name='type' value='<?php echo htmlspecialchars($sticky_type); ?>' required>
        </div>

        <!-- price -->
        <p id='price_feedback' class='feedback-message <?php echo $price_feedback_class; ?>'>Please provide a valid price.</p>
        <div class='group-label-input'>
          <label for='add_price'>Price:</label>
          <input id='add_price' type='number' name='price' value='<?php echo htmlspecialchars($sticky_price); ?>' required>
        </div>

        <!-- MAX_FILE_SIZE must precede the file input field -->
        <input type='hidden' name='MAX_FILE_SIZE' value='<?php echo MAX_FILE_SIZE; ?>' />

        <!-- file_name -->
        <p id='file_name_feedback' class='feedback-message <?php echo $file_name_feedback_class; ?>'>Please provide a valid file name.</p>
        <div class='group-label-input'>
          <label for='add_file_name'>File Name:</label>
          <input id='add_file_name' type='text' name='file_name' value='<?php echo htmlspecialchars($sticky_file_name); ?>' required>
        </div>

        <!-- file_ext -->
        <p id='file_ext_feedback' class='feedback-message <?php echo $file_ext_feedback_class; ?>'>Please provide a valid file extension.</p>
        <div class='group-label-input'>
          <label for='add_file_ext'>File Extension:</label>
          <input id='add_file_ext' type='text' name='file_ext' value='<?php echo strtolower(htmlspecialchars($sticky_file_ext)); ?>' required>
        </div>

        <!-- source -->
        <p id='source_feedback' class='feedback-message <?php echo $source_feedback_class; ?>'>Please provide a valid source.</p>
        <div class='group-label-input'>
          <label for='add_source'>Source:</label>
          <input id='add_source' type='text' name='source' value='<?php echo htmlspecialchars($sticky_source); ?>' required>
        </div>

        <input class='submit' id='add_reptile_submit' name='add_reptile_submit' type='submit' value='Submit' />
      </form>


      <h2>Remove Reptile From Collection</h2>

      <form id='remove_reptile_form' method='post' action='/' novalidate>

        <!-- name -->
        <p id='remove_name_feedback' class='feedback-message <?php echo $remove_reptile_feedback_class; ?>'>Please select a reptile to remove.</p>
        <div class='group-label-input'>
          <label for='remove_reptile_name'>Select Reptile:</label>
          <select id='remove_reptile_name' name='remove_reptile_select' required>
            <option value='' selected> --Select a Reptile-- </option>
            <?php foreach ($records as $record) { ?>
              <option value='<?php echo htmlspecialchars($record['id']); ?>'>id=<?php echo htmlspecialchars($record['id']) . ', ' . htmlspecialchars($record['species']); ?></option>
            <?php } ?>
          </select>
        </div>

        <input class='submit' id='remove_reptile_submit' name='remove_reptile_submit' type='submit' value='Submit' />
      </form>


      <h2>Create New Tag</h2>

      <form id='create_tag_form' method='post' action='/' novalidate>

        <!-- tag_name -->
        <p id='tag_name_feedback' class='feedback-message <?php echo $tag_name_feedback_class; ?>'>Please provide a valid tag name.</p>
        <div class='group-label-input'>
          <label for='create_tag_name'>Tag Name:</label>
          <input id='create_tag_name' type='text' name='tag_name' value='<?php echo htmlspecialchars($sticky_tag_name); ?>' required>
        </div>

        <input class='submit' id='create_tag_submit' name='create_tag_submit' type='submit' value='Submit' />
      </form>

      <h2>Add Tag to Reptile</h2>

      <form id='add_tag_form' method='post' action='/' novalidate>

        <!-- reptile selection -->
        <p id='add_tag_reptile_feedback' class='feedback-message <?php echo $add_tag_reptile_feedback_class; ?>'>Please select a reptile.</p>
        <div class='group-label-input-add-tag'>
          <label for='add_tag_reptile_name'>Select Reptile:</label>
          <select id='add_tag_reptile_name' name='add_tag_reptile_select' required>
            <option value='' selected> --Select a Reptile-- </option>
            <?php foreach ($records as $record) { ?>
              <option value='<?php echo htmlspecialchars($record['id']); ?>'>id=<?php echo htmlspecialchars($record['id']) . ', ' . htmlspecialchars($record['species']); ?></option>
            <?php } ?>
          </select>
        </div>

        <!-- tag selection -->
        <p id='add_tag_feedback' class='feedback-message <?php echo $add_tag_feedback_class; ?>'>Please select a tag.</p>
        <div class='group-label-input-add-tag'>
          <label for='add_tag_name'>Select Tag to Add:</label>
          <select id='add_tag_name' name='add_tag_select' required>
            <option value='' selected> --Select a Tag-- </option>
            <?php foreach ($tags as $tag) { ?>
              <option value='<?php echo htmlspecialchars($tag['id']); ?>'><?php echo htmlspecialchars($tag['tag_name']); ?></option>
            <?php } ?>
          </select>
        </div>

        <input class='add_tag_submit' id='add_tag_submit' name='add_tag_submit' type='submit' value='Submit' />

      </form>

      <h2>Remove Tag From Reptile</h2>

      <form id='remove_tag_form' method='post' action='/' novalidate>

        <!-- reptile selection -->
        <p id='remove_tag_reptile_feedback' class='feedback-message <?php echo $remove_tag_reptile_feedback_class; ?>'>Please select a reptile.</p>
        <div class='group-label-input-add-tag'>
          <label for='remove_tag_reptile_name'>Select Reptile:</label>
          <select id='remove_tag_reptile_name' name='remove_tag_reptile_select' required>
            <option value='' selected> --Select a Reptile-- </option>
            <?php foreach ($records as $record) { ?>
              <option value='<?php echo htmlspecialchars($record['id']); ?>'>id=<?php echo htmlspecialchars($record['id']) . ', ' . htmlspecialchars($record['species']); ?></option>
            <?php } ?>
          </select>
        </div>

        <!-- tag selection -->
        <p id='remove_tag_feedback' class='feedback-message <?php echo $remove_tag_feedback_class; ?>'>Please select a tag.</p>
        <div class='group-label-input-add-tag'>
          <label for='remove_tag_name'>Select Tag to Add:</label>
          <select id='remove_tag_name' name='remove_tag_select' required>
            <option value='' selected> --Select a Tag-- </option>
            <?php foreach ($tags as $tag) { ?>
              <option value='<?php echo htmlspecialchars($tag['id']); ?>'><?php echo htmlspecialchars($tag['tag_name']); ?></option>
            <?php } ?>
          </select>
        </div>

        <input class='add_tag_submit' id='remove_tag_submit' name='remove_tag_submit' type='submit' value='Submit' />

      </form>

    <?php } ?>
  </main>

  <?php include('includes/footer.php'); ?>

</body>

</html>
