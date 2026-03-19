# brBrbr-PHP7

WordPressの標準フィルター `wpautop` を置き換え、改行をそのまま `<br>` タグに変換するプラグインです。

## 概要

WordPressはデフォルトで `wpautop` フィルターにより改行を `<p>` タグに自動変換しますが、意図しないレイアウト崩れの原因になることがあります。このプラグインは `wpautop` を無効化し、改行を素直に `<br>` へ変換します。

## 機能

- 投稿本文・コメントの改行を `<br>` に変換
- ブロックレベルHTML要素（`table`, `div`, `ul`, `pre` 等）直後の不要な `<br>` を自動除去
- `<pre>`, `<script>`, `<form>` ブロック内の `<br>` を除去
- `<blockquote>` の段落ラッピング対応

## インストール

1. このリポジトリをダウンロードまたは `git clone` する
2. `brBrbr-PHP7` ディレクトリを `wp-content/plugins/` に配置する
3. WordPress管理画面の「プラグイン」から有効化する

## 動作要件

- WordPress 4.0 以上
- PHP 5.3 以上（PHP 7.x / 8.x 対応）

## オリジナル

[brBrbr](http://camcam.info/wordpress/101/) by CamCam をPHP7対応としてフォークしたものです。

## ライセンス

GPLv2
