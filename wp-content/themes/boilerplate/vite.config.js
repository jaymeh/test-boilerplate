import { defineConfig } from 'vite';
import { resolve } from 'path';
import { manageHotReloadFile } from './core/js/hot-reload.js';

const DDEV_HOSTNAME = `${process.env.DDEV_HOSTNAME}`;
const HOT_RELOAD_PORT = '5173';

export default defineConfig(
	(command) => {
		manageHotReloadFile(command.mode, DDEV_HOSTNAME, HOT_RELOAD_PORT);

		return {
			build: {
				// generate .vite/manifest.json in outDir
				manifest: true,
				rollupOptions: {
					// overwrite default .html entry
					input: {
						main: resolve(__dirname, 'src/main.js'),
						admin: resolve(__dirname, 'src/admin.js'),
						header: resolve(__dirname, 'src/components/header.js'),
					}
				},
				outDir: 'dist'
			},
			server: {
				// respond to all network requests (same as '0.0.0.0')
				host: true,
				// we need a strict port to match on PHP side
				strictPort: true,
				port: HOT_RELOAD_PORT,
				hmr: {
					// Force the Vite client to connect via SSL
					// This will also force a "https://" URL in the hot file
					protocol: 'wss',
					// The host where the Vite dev server can be accessed
					// This will also force this host to be written to the hot file
					host: DDEV_HOSTNAME,
				}
			},
		}
	}
);
