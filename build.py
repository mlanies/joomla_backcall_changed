#!/usr/bin/env python3
"""
Build com_backcall.zip and mod_backcall.zip from original archives
with patched files from backcall_changed/.

Usage:
  1. Place original archives in backcall_original/:
     - backcall_1.0.5/com_backcall.zip
     - backcall_1.0.5/mod_backcall.zip
  2. Run: python build.py

File mapping (backcall_changed/ -> zip structure):
  administrator/components/com_backcall/backcall.xml -> com_backcall.zip: backcall.xml
  administrator/components/com_backcall/script.php   -> com_backcall.zip: script.php
  administrator/components/com_backcall/*            -> com_backcall.zip: administrator/*
  administrator/language/*                           -> com_backcall.zip: administrator/languages/*
  language/ru-RU/com_backcall*                       -> com_backcall.zip: site/languages/ru-RU/*
  modules/mod_backcall/*                             -> mod_backcall.zip: *
  language/ru-RU/mod_backcall*                       -> mod_backcall.zip: language/ru-RU/*
"""
import zipfile
import os
import sys

ORIGINAL = "backcall_1.0.5"
CHANGED = "backcall_changed"


def build_zip(original_zip, output_zip, replacements):
    """Copy original zip, replacing files from replacements dict."""
    if not os.path.exists(original_zip):
        print(f"  ERROR: {original_zip} not found")
        return False

    patched = []
    with zipfile.ZipFile(original_zip, "r") as zin, \
         zipfile.ZipFile(output_zip, "w", zipfile.ZIP_DEFLATED) as zout:

        for item in zin.infolist():
            if item.filename in replacements:
                with open(replacements[item.filename], "rb") as f:
                    zout.writestr(item, f.read())
                patched.append(item.filename)
                del replacements[item.filename]
            else:
                zout.writestr(item, zin.read(item.filename))

        # New files not present in original
        for arc_name, local_path in replacements.items():
            with open(local_path, "rb") as f:
                zout.writestr(arc_name, f.read())
            patched.append(arc_name + " (new)")

    print(f"  {output_zip}: {os.path.getsize(output_zip)} bytes")
    for f in sorted(patched):
        print(f"    patched: {f}")
    return True


def collect_replacements():
    """Scan backcall_changed/ and build replacement maps."""
    com = {}
    mod = {}

    for dirpath, _, filenames in os.walk(CHANGED):
        for fname in filenames:
            full = os.path.join(dirpath, fname)
            rel = os.path.relpath(full, CHANGED).replace("\\", "/")

            # --- com_backcall.zip ---
            if rel.startswith("administrator/components/com_backcall/"):
                inner = rel.replace("administrator/components/com_backcall/", "", 1)
                if inner in ("backcall.xml", "script.php"):
                    com[inner] = full
                else:
                    com["administrator/" + inner] = full

            elif rel.startswith("administrator/language/"):
                inner = rel.replace("administrator/language/", "", 1)
                com["administrator/languages/" + inner] = full

            elif rel.startswith("language/ru-RU/com_backcall"):
                inner = rel.replace("language/", "", 1)
                com["site/languages/" + inner] = full

            # --- mod_backcall.zip ---
            elif rel.startswith("modules/mod_backcall/"):
                inner = rel.replace("modules/mod_backcall/", "", 1)
                mod[inner] = full

            elif rel.startswith("language/ru-RU/mod_backcall"):
                inner = rel.replace("language/", "", 1)
                mod["language/" + inner] = full

    return com, mod


if __name__ == "__main__":
    if not os.path.exists(ORIGINAL):
        print(f"Error: folder '{ORIGINAL}/' not found.")
        print(f"Place original com_backcall.zip and mod_backcall.zip in {ORIGINAL}/.")
        sys.exit(1)

    com_repl, mod_repl = collect_replacements()

    print("Building com_backcall.zip ...")
    build_zip(f"{ORIGINAL}/com_backcall.zip", "com_backcall.zip", com_repl)

    print("Building mod_backcall.zip ...")
    build_zip(f"{ORIGINAL}/mod_backcall.zip", "mod_backcall.zip", mod_repl)

    print("\nDone.")
