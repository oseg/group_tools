<?php
/**
 * Configure group tool presets
 *
 * @uses $vars['group_tool_presets'] the current group tool presets (if any)
 */
$presets = elgg_extract("group_tool_presets", $vars);
$group_tools = elgg_get_config("group_tool_options");

// list existing
if (!empty($presets)) {

	foreach ($presets as $index => $values) {
		echo "<div>";
		echo "<div class='float-alt'>";
		echo elgg_view("output/url", array("href" => "#", "class" => "group-tools-admin-edit-tool-preset", "text" => elgg_echo("edit")));
		echo elgg_view("output/url", array("href" => "#", "class" => "group-tools-admin-delete-tool-preset", "text" => elgg_view_icon("delete")));
		echo "</div>";
		echo "<label rel='title'>" . elgg_extract("title", $values) . "</label><br />"; // title
		echo "<div class='elgg-output elgg-quiet' rel='description'>" . elgg_extract("description", $values) . "</div>"; // description
		echo "<div class='hidden'>"; // edit part
		echo "<div class='mbs'>";
		echo "<label>" . elgg_echo("title") . "</label>";
		echo elgg_view("input/text", array(
			"name" => "params[" . $index . "][title]",
			"value" => elgg_extract("title", $values),
			"class" => "group-tools-admin-change-tool-preset-title"
		));
		echo "</div>";
		echo "<div class='mbs'>";
		echo "<label>" . elgg_echo("description") . "</label>";
		echo elgg_view("input/plaintext", array(
			"name" => "params[" . $index . "][description]",
			"value" => elgg_extract("description", $values),
			"class" => "group-tools-admin-change-tool-preset-description"));
		echo "</div>";
		foreach ($group_tools as $group_tool) {
			$group_tool_toggle_name = "params[" . $index . "][tools][" . $group_tool->name . "_enable]";

			echo elgg_view("group_tools/elements/group_tool", array(
				"group_tool" => $group_tool,
				"value" => elgg_extract($group_tool->name . "_enable", $values["tools"]),
				"name" => $group_tool_toggle_name,
				"class" => "mbs"
			));
		}
		echo "</div>"; // end edit part
		echo "</div>";
	}
}

// hidden wrapper for clone
echo "<div id='group-tools-tool-preset-base' class='hidden'>";
echo "<div class='float-alt'>";
echo elgg_view("output/url", array("href" => "#", "class" => "group-tools-admin-edit-tool-preset", "text" => elgg_echo("edit")));
echo elgg_view("output/url", array("href" => "#", "class" => "group-tools-admin-delete-tool-preset", "text" => elgg_view_icon("delete")));
echo "</div>";
echo "<label rel='title'>" . elgg_echo("title") . "</label><br />"; // title
echo "<div class='elgg-output elgg-quiet' rel='description'>" . elgg_echo("description") . "</div>"; // description
echo "<div class='hidden'>"; // edit part
echo "<div class='mbs'>";
echo "<label>" . elgg_echo("title") . "</label>";
echo elgg_view("input/text", array("name" => "params[i][title]", "class" => "group-tools-admin-change-tool-preset-title"));
echo "</div>";
echo "<div class='mbs'>";
echo "<label>" . elgg_echo("description") . "</label>";
echo elgg_view("input/plaintext", array("name" => "params[i][description]", "class" => "group-tools-admin-change-tool-preset-description"));
echo "</div>";
foreach ($group_tools as $group_tool) {
	$group_tool_toggle_name = "params[i][tools][" . $group_tool->name . "_enable]";

	echo elgg_view("group_tools/elements/group_tool", array(
		"group_tool" => $group_tool,
		"value" => "no",
		"name" => $group_tool_toggle_name,
		"class" => "mbs"
	));
}
echo "</div>"; // end edit part
echo "</div>";

// save button
echo "<div class='elgg-footer'>";
echo elgg_view("input/submit", array("value" => elgg_echo("save")));
echo "</div>";
?>
<script>
	require(['group_tools/group_tool_presets']);
</script>