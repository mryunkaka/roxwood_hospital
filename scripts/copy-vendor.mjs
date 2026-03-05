import { mkdir, readFile, writeFile, copyFile } from "node:fs/promises";
import path from "node:path";

const projectRoot = process.cwd();
const vendorDir = path.join(projectRoot, "public", "assets", "vendor");

const packageJsonPath = path.join(projectRoot, "package.json");
const packageJson = JSON.parse(await readFile(packageJsonPath, "utf8"));

await mkdir(vendorDir, { recursive: true });

const vendorFiles = [
  {
    name: "htmx",
    version: packageJson.dependencies["htmx.org"],
    from: path.join(projectRoot, "node_modules", "htmx.org", "dist", "htmx.min.js"),
    to: path.join(vendorDir, "htmx.min.js"),
  },
  {
    name: "alpine",
    version: packageJson.dependencies["alpinejs"],
    from: path.join(projectRoot, "node_modules", "alpinejs", "dist", "cdn.min.js"),
    to: path.join(vendorDir, "alpine.min.js"),
  },
];

for (const file of vendorFiles) {
  await copyFile(file.from, file.to);
}

const versions = {
  vendor: Object.fromEntries(vendorFiles.map((f) => [f.name, f.version])),
};

await writeFile(path.join(vendorDir, "versions.json"), JSON.stringify(versions, null, 2));
