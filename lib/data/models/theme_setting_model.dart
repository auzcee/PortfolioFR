// lib/data/models/theme_setting_model.dart
// Table: theme_settings  (one-to-one with users)
// Persists per-user theme preference purely in SQLite.
// ─────────────────────────────────────────────────────────────────────────────

/// Maps to Flutter's ThemeMode values stored as strings in SQLite.
enum AppThemeMode { light, dark, system }

extension AppThemeModeExtension on AppThemeMode {
  String get value => name;

  static AppThemeMode fromString(String v) => AppThemeMode.values.firstWhere(
    (e) => e.name == v,
    orElse: () => AppThemeMode.system,
  );
}

class ThemeSettingModel {
  final int? id;
  final int userId;
  final AppThemeMode themeMode;
  final String? primaryColorHex; // Override brand colour per user (future)
  final String updatedAt;

  const ThemeSettingModel({
    this.id,
    required this.userId,
    this.themeMode = AppThemeMode.system,
    this.primaryColorHex,
    required this.updatedAt,
  });

  factory ThemeSettingModel.fromMap(Map<String, dynamic> map) =>
      ThemeSettingModel(
        id: map['id'] as int?,
        userId: map['user_id'] as int,
        themeMode: AppThemeModeExtension.fromString(
          map['theme_mode'] as String? ?? 'system',
        ),
        primaryColorHex: map['primary_color_hex'] as String?,
        updatedAt: map['updated_at'] as String,
      );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'user_id': userId,
    'theme_mode': themeMode.value,
    'primary_color_hex': primaryColorHex,
    'updated_at': updatedAt,
  };

  ThemeSettingModel copyWith({
    int? id,
    int? userId,
    AppThemeMode? themeMode,
    String? primaryColorHex,
    String? updatedAt,
  }) => ThemeSettingModel(
    id: id ?? this.id,
    userId: userId ?? this.userId,
    themeMode: themeMode ?? this.themeMode,
    primaryColorHex: primaryColorHex ?? this.primaryColorHex,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() =>
      'ThemeSettingModel(id: $id, userId: $userId, mode: ${themeMode.name})';
}
