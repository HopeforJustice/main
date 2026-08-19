module.exports = function (devPlugins, distPlugins) {
	return {
    // Enable overwrite to delete symlinks before recreating them
    options: {
      overwrite: false
    },
    // The "build/target.txt" symlink will be created and linked to
    // "source/target.txt". It should appear like this in a file listing:
    // build/target.txt -> ../source/target.txt
    //
    // acf-json is NOT symlinked here (it used to be) - the build gets
    // dragged into FileZilla by hand, and FTP clients don't follow
    // symlinks on upload, so a symlinked acf-json silently uploads empty.
    // See copy:acf in copy.js for the real, deployable copy instead.
    expanded: {
      files: [
        {
          expand: false,
          src: devPlugins,
          dest: distPlugins
        }
      ]
    }
	}
}