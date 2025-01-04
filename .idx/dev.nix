{pkgs}: {
  channel = "stable-24.05";
  packages = [
    pkgs.php81
    pkgs.php81Packages.composer
    pkgs.nodejs_20
  ];
  services.mysql = {
    enable = true;
    package = pkgs.mariadb;
  };
  idx.extensions = [
    "svelte.svelte-vscode"
    "vue.volar"
  ];
  idx.previews = {
    previews = {
      web = {
        command = [
          "npm"
          "run"
          "dev"
          "--"
          "--port"
          "$PORT"
          "--host"
          "0.0.0.0"
        ];
        manager = "web";
      };
    };
  };
}