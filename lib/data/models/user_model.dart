// lib/data/models/user_model.dart
// Table: users
// ─────────────────────────────────────────────────────────────────────────────

class UserModel {
  final int? id;
  final String username;
  final String email;
  final String passwordHash;
  final String? fullName;
  final String? bio;
  final String? avatarPath;
  final String? phoneNumber;
  final String? location;
  final String? websiteUrl;
  final String createdAt;
  final String updatedAt;

  const UserModel({
    this.id,
    required this.username,
    required this.email,
    required this.passwordHash,
    this.fullName,
    this.bio,
    this.avatarPath,
    this.phoneNumber,
    this.location,
    this.websiteUrl,
    required this.createdAt,
    required this.updatedAt,
  });

  // ── Serialisation ─────────────────────────────────────────────────────────────
  factory UserModel.fromMap(Map<String, dynamic> map) => UserModel(
    id: map['id'] as int?,
    username: map['username'] as String,
    email: map['email'] as String,
    passwordHash: map['password_hash'] as String,
    fullName: map['full_name'] as String?,
    bio: map['bio'] as String?,
    avatarPath: map['avatar_path'] as String?,
    phoneNumber: map['phone_number'] as String?,
    location: map['location'] as String?,
    websiteUrl: map['website_url'] as String?,
    createdAt: map['created_at'] as String,
    updatedAt: map['updated_at'] as String,
  );

  Map<String, dynamic> toMap() => {
    if (id != null) 'id': id,
    'username': username,
    'email': email,
    'password_hash': passwordHash,
    'full_name': fullName,
    'bio': bio,
    'avatar_path': avatarPath,
    'phone_number': phoneNumber,
    'location': location,
    'website_url': websiteUrl,
    'created_at': createdAt,
    'updated_at': updatedAt,
  };

  UserModel copyWith({
    int? id,
    String? username,
    String? email,
    String? passwordHash,
    String? fullName,
    String? bio,
    String? avatarPath,
    String? phoneNumber,
    String? location,
    String? websiteUrl,
    String? createdAt,
    String? updatedAt,
  }) => UserModel(
    id: id ?? this.id,
    username: username ?? this.username,
    email: email ?? this.email,
    passwordHash: passwordHash ?? this.passwordHash,
    fullName: fullName ?? this.fullName,
    bio: bio ?? this.bio,
    avatarPath: avatarPath ?? this.avatarPath,
    phoneNumber: phoneNumber ?? this.phoneNumber,
    location: location ?? this.location,
    websiteUrl: websiteUrl ?? this.websiteUrl,
    createdAt: createdAt ?? this.createdAt,
    updatedAt: updatedAt ?? this.updatedAt,
  );

  @override
  String toString() => 'UserModel(id: $id, username: $username, email: $email)';
}
