#!/bin/bash

PLUGIN_NAME="plugin-cobro-arriendo"
ZIP_FILE="${PLUGIN_NAME}.zip"

# Cleanup old zip if it exists
rm -f "$ZIP_FILE"

# Create temp directory
mkdir -p "$PLUGIN_NAME"

# Copy plugin file into the folder
cp plugin-cobro-arriendo.php "$PLUGIN_NAME/"

# Create the zip archive
zip -r "$ZIP_FILE" "$PLUGIN_NAME"

# Clean up temp folder
rm -r "$PLUGIN_NAME"

echo "✅ Created $ZIP_FILE with plugin file inside folder: $PLUGIN_NAME"